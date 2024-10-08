<?php

namespace App\Http\Controllers\Mobile;

use App\Helpers\LogHelper;
use App\Http\Controllers\Controller;
use App\Mail\FileMail;
use App\Models\CartMerch;
use App\Models\Master\JenisPengiriman;
use App\Models\Master\Merch;
use App\Models\Trans;
use App\Models\TransLine;
use App\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use DB;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MobileWebController extends Controller
{
    public function __construct(Trans $model, User $user)
    {
        $this->title            = 'Mobile';
        $this->subtitle         = 'Mobile';
        $this->model_request    = Request::class;
        $this->folder           = '';
        $this->relation         = ['customer', 'lines', 'jenisPengiriman', 'payment'];
        $this->model            = $model;
        $this->user            = $user;
        $this->withTrashed      = false;
    }

    public function formData()
    {
        return [
            'list_product' => Merch::all(),
            'count_cart'   => CartMerch::where('created_by', auth()->user()->id)->count()
        ];
    }

    public function index(Request $request)
    {
        if (auth()->user()->roles->first()->name == 'SUPERADMIN') {
            return redirect()->route('siteurl');
        }

        $view  = [
            'title'         => 'Home',
            'subtitle'      => 'Home',
            'folder'        => $this->folder ?? '',
            'items'         => method_exists($this, 'ajaxData') ? null : $this->indexData($this->withTrashed),
            'url'           => array_merge(['store' => $this->generateUrl('store'), 'edit' => $this->generateUrl('edit'), 'destroy' => $this->generateUrl('destroy'), 'foto' => $this->generateUrl('foto')], $this->completeUrl()),
            'data'          => method_exists($this, 'formData') ? $this->formData() : null,
            'form'          => $this->generateViewName('form'),
        ];
        return view($this->generateViewName(__FUNCTION__))->with($view);
    }

    public function product(Request $request)
    {
        $merch      = Merch::all();

        $view  = [
            'title'     => $this->title,
            'subtitle'  => $this->subtitle,
            'data'      => [
                'product' => $merch,
            ],
            'items'      => $merch,

        ];
        return view($this->generateViewName('product'))->with($view);
    }


    public function productDetail(Request $request, $id)
    {
        $merch = Merch::find($id);

        $view  = [
            'title'     => $this->title,
            'subtitle'  => $this->subtitle,
            'data'      => [
                'list_product' => Merch::where('id', '<>', $id)->get(),
            ],
            'item'      => $merch,
        ];

        return view($this->generateViewName('product-detail'))->with($view);
    }

    public function history(Request $request)
    {
        $view  = [
            'title'     => $this->title,
            'subtitle'  => $this->subtitle,
            'data'      => [],
            'items'     => $this->model->with(['lines'])->where('customer_id', auth()->user()->id)->orderBy('id', 'desc')->get(),
        ];
        return view($this->generateViewName(__FUNCTION__))->with($view);
    }

    ///cart
    public function cart(Request $request)
    {
        $view  = [
            'title'     => 'Cart',
            'subtitle'  => 'Cart',
            'data'      => [],
            'items'     => CartMerch::with(['merch'])->where('created_by', auth()->user()->id)->get(),

        ];
        return view($this->generateViewName(__FUNCTION__))->with($view);
    }

    public function historyDetail(Request $request, $id)
    {
        $item           =  $this->model->with($this->relation)->find($id);

        if (!empty($item)) {
            $view  = [
                'title'     => $this->title,
                'subtitle'  => $this->subtitle,
                'item'      => $item,
            ];
            return view($this->generateViewName('history-detail'))->with($view);
        }
    }
    public function historyReject(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $trans = $this->model->with(['lines'])->find($id);

            if (!empty($trans)) {
                $trans->update([
                    'status' => 'rejected',
                    'text_reject' => 'Pembatalan oleh Customer',
                    'rejected_by' => auth()->user()->id,
                    'rejected_at' => date('Y-m-d H:i:s'),
                ]);

                foreach ($trans->lines as $key => $line) {
                    $merch = Merch::find($line->merch_id);
                    $merch->increment('stok', $line->qty);
                }
            }

            DB::commit();

            $response           = [
                'status'            => true,
                'msg'               => 'Data Saved.',
            ];
            return response()->json($response);
        } catch (Exception $e) {

            DB::rollback();

            $response           = [
                'status'            => false,
                'msg'               => $e->getMessage(),
            ];
            return response()->json($response);
        }
    }

    public function cartStore(Request $request)
    {
        try {
            DB::beginTransaction();

            $data = $this->getRequest();
            $userId = auth()->user()->id;

            // Validate quantity
            if ($data['qty'] < 1) {
                return response()->json([
                    'status' => false,
                    'msg'    => 'Jumlah tidak boleh 0',
                ]);
            }

            // Update or create cart item
            $model = CartMerch::updateOrCreate(
                [
                    'created_by' => $userId,
                    'merch_id'   => $data['merch_id'],
                ],
                [
                    'qty' => DB::raw('COALESCE(qty, 0) + ' . $data['qty']),
                ]
            );

            DB::commit();

            return response()->json([
                'status' => true,
                'msg'    => 'Data Saved.',
            ]);
        } catch (Exception $e) {
            DB::rollback();

            return response()->json([
                'status' => false,
                'msg'    => $e->getMessage(),
            ]);
        }
    }


    public function cartUpdate(Request $request)
    {
        try {
            DB::beginTransaction();

            $data = $this->getRequest();
            $userId = auth()->user()->id;

            foreach ($data['items'] as $item) {
                $merch = Merch::find($item['merch_id']);

                // Validate quantity
                if ($item['qty'] > $merch->stok) {
                    return response()->json([
                        'status' => false,
                        'msg'    => 'Maks. Pembelian barang ini ' . $merch->stok . ', kurangi pembelianmu, ya!',
                    ]);
                }

                if ($item['qty'] < 1) {
                    return response()->json([
                        'status' => false,
                        'msg'    => 'Jumlah tidak boleh 0',
                    ]);
                }

                // Update cart item quantity
                CartMerch::where([
                    'created_by' => $userId,
                    'merch_id'   => $item['merch_id'],
                ])->update(['qty' => $item['qty']]);
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'msg'    => 'Data Saved.',
            ]);
        } catch (Exception $e) {
            DB::rollback();

            return response()->json([
                'status' => false,
                'msg'    => $e->getMessage(),
            ]);
        }
    }


    public function cartDelete(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $cart = CartMerch::find($id);

            if (!empty($cart)) {
                $cart->delete();
            }

            DB::commit();

            $response           = [
                'status'            => true,
                'msg'               => 'Data Saved.',
            ];
            return response()->json($response);
        } catch (Exception $e) {

            DB::rollback();

            $response           = [
                'status'            => false,
                'msg'               => $e->getMessage(),
            ];
            return response()->json($response);
        }
    }
    ///cart

    //order
    public function order(Request $request)
    {
        $cart           =  CartMerch::with(['merch'])->where('created_by', auth()->user()->id)->get();

        if ($cart->isNotEmpty()) {
            $view  = [
                'title'     => $this->title,
                'subtitle'  => $this->subtitle,
                'data'      => [
                    'list_jenis_pengiriman' => JenisPengiriman::get(),
                    'cart'                  => $cart,
                    'list_provinsi'                  => $this->listProvinsi(),
                ],
            ];
            return view($this->generateViewName(__FUNCTION__))->with($view);
        } else {
            return redirect()->route('mobile.index');
        }
    }

    public function orderStore(Request $request)
    {
        try {
            DB::beginTransaction();

            $data = $this->getRequest();
            $pengirimanRequiredFields = ['alamat', 'provinsi_id', 'kabupaten_id', 'kecamatan_id', 'kelurahan_id'];

            // Validate shipping address for specific delivery type
            if ($data['jenis_pengiriman_id'] == 1) {
                foreach ($pengirimanRequiredFields as $field) {
                    if (empty($data[$field])) {
                        return $this->redirectBackWithError('Alamat wajib diinputkan untuk data pengiriman');
                    }
                }
            }

            // Validate shipping proof
            if (!$request->hasFile('bukti_pengiriman')) {
                return $this->redirectBackWithError('Bukti Pengiriman wajib diinputkan');
            }

            // Check stock availability
            $cartMerch = CartMerch::where('created_by', auth()->user()->id)->get();
            foreach ($cartMerch as $cart) {
                if ($cart->qty > $cart->merch->stok) {
                    return $this->redirectBackWithError('Stok sudah berkurang, Maks. Pembelian barang ini ' . $cart->merch->stok . ', kurangi pembelianmu, ya!');
                }
            }

            // Create transaction
            $createTrans = [
                'no'                  => $this->gen_number($this->model, 'no', 'TR$$-@@#####', date('Y-m-d'), 'tanggal', true),
                'tanggal'             => date('Y-m-d'),
                'customer_id'         => auth()->user()->id,
                'jenis_pengiriman_id' => $data['jenis_pengiriman_id'],
                'text'                => $data['text'],
                'provinsi_id'         => isset($data['provinsi_id']) ? $data['provinsi_id'] : null,
                'kabupaten_id'        => isset($data['kabupaten_id']) ? $data['kabupaten_id'] : null,
                'kecamatan_id'        => isset($data['kecamatan_id']) ? $data['kecamatan_id'] : null,
                'kelurahan_id'        => isset($data['kelurahan_id']) ? $data['kelurahan_id'] : null,
                'alamat'              => isset($data['alamat']) ? $data['alamat'] : null,
                'status'              => 'open',
            ];
            $model = $this->model->create($createTrans);

            // Save shipping proof
            if ($request->hasFile('bukti_pengiriman')) {
                $filename = $this->saveFoto($request->bukti_pengiriman, 'bukti_pengiriman/' . $model->id);
                $model->update(['bukti' => $filename]);
            }

            // Process cart items to transaction lines and update stock
            $cartToLines = [];
            foreach ($cartMerch as $cart) {
                $cartToLines[] = [
                    'trans_id' => $model->id,
                    'merch_id' => $cart->merch_id,
                    'size'     => $cart->merch->size,
                    'qty'      => $cart->qty,
                    'harga'    => $cart->merch->harga,
                ];
            }

            if (!empty($cartToLines)) {
                TransLine::insert($cartToLines);

                foreach ($cartToLines as $cartLine) {
                    $merch = Merch::find($cartLine['merch_id']);
                    $merch->decrement('stok', $cartLine['qty']);
                }

                CartMerch::where('created_by', auth()->user()->id)->delete();
            }

            // Send invoice email
            if (!empty($model->customer->email)) {
                $pdfName = $this->makePdfInvoice($model);
                $filePath = 'invoice/' . $model->id . '/' . $pdfName;
                Mail::to($model->customer->email)->send(new FileMail($filePath, $model));
            }

            DB::commit();
            return redirect()->route($this->generateUrl('history-detail'), $model->id)
                ->withSuccess('Pemesanan Telah Berhasil');
        } catch (Exception $e) {
            DB::rollback();
            return $this->redirectBackWithError($e->getMessage());
        }
    }



    public function makePdfInvoice($model)
    {
        $view['item']           = $model;

        $pdf = Pdf::loadView('trans.print', $view);
        $pdf->setOption('enable-javascript', true);
        $pdf->setOption('javascript-delay', 5000);
        $pdf->setOption('enable-smart-shrinking', true);
        $pdf->setOption('no-stop-slow-scripts', true);

        $content    = $pdf->download()->getOriginalContent();
        $pdf_name   = 'invoice - ' . $model->no . '.pdf';

        Storage::put('public/invoice/' . $model->id . '/' . $pdf_name, $content);

        return $pdf_name;
    }


    ///PROFILE
    public function profile(Request $request)
    {
        $view  = [
            'title'     => 'Profile',
            'subtitle'  => 'Profile',
            'item'      => auth()->user(),
        ];
        return view($this->generateViewName('profile'))->with($view);
    }


    public function profileEdit(Request $request)
    {
        $view  = [
            'title'     => 'Edit Profile',
            'subtitle'  => 'Edit Profile',
            'item'      => auth()->user(),
        ];
        return view($this->generateViewName('profile-edit'))->with($view);
    }

    public function profileUpdate(Request $request, $id)
    {
        try {

            DB::beginTransaction();

            $data  = $this->getRequest();

            $model = $this->user->findOrFail($id);

            if ($data['password'] == "") {
                $model->update([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'nowa' => $data['nowa'],
                ]);
            } else {
                $model->update([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'nowa' => $data['nowa'],
                    'password' => $data['password'],
                ]);
            }

            $model->syncRoles('GUEST');

            $log_helper     = new LogHelper;

            $log_helper->storeLog('edit', $model->no ?? $model->id, $this->subtitle);

            DB::commit();
            if ($request->ajax()) {
                $response           = [
                    'status'            => true,
                    'msg'               => 'Data Saved.',
                ];
                return response()->json($response);
            } else {
                return redirect()->route($this->generateUrl('index'))
                    ->withSuccess('Berhasil');
            }
        } catch (Exception $e) {

            DB::rollback();
            if ($request->ajax()) {
                $response           = [
                    'status'            => false,
                    'msg'               => $e->getMessage(),
                ];
                return response()->json($response);
            } else {
                return $this->redirectBackWithError($e->getMessage());
            }
        }
    }
}
