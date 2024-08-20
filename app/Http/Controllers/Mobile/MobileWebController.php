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
        $this->withTrashed      = true;
    }

    public function formData()
    {
        return [
            'list_product' => Merch::all(),
        ];
    }

    public function index(Request $request)
    {
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

            $data  = $this->getRequest();

            if ($data['qty'] < 1) {
                $response           = [
                    'status'            => false,
                    'msg'               => 'Jumlah tidak boleh 0',
                ];
                return response()->json($response);
            }

            $model = CartMerch::where([
                'created_by' => auth()->user()->id,
                'merch_id' => $data['merch_id'],
            ])->first();

            $model = CartMerch::updateOrCreate(
                [
                    'created_by' => auth()->user()->id,
                    'merch_id' => $data['merch_id'],
                ],
                [
                    'qty' => ($model->qty ?? 0) + $data['qty'],
                ]
            );

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

    public function cartUpdate(Request $request)
    {
        try {
            DB::beginTransaction();

            $data  = $this->getRequest();

            foreach ($data['items'] as $item) {

                if ($item['qty'] < 1) {
                    $response           = [
                        'status'            => false,
                        'msg'               => 'Jumlah tidak boleh 0',
                    ];
                    return response()->json($response);
                }

                $model = CartMerch::where([
                    'created_by' => auth()->user()->id,
                    'merch_id' => $item['merch_id'],
                ])->update([
                    'qty' => $item['qty'],
                ]);
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

            if ($data['jenis_pengiriman_id'] == 1) {
                foreach ($pengirimanRequiredFields as $field) {
                    if (empty($data[$field])) {
                        return $this->redirectBackWithError('Alamat wajib diinputkan untuk data pengiriman');
                    }
                }
            }

            if (!$request->hasFile('bukti_pengiriman')) {
                return $this->redirectBackWithError('Bukti Pengiriman wajib diinputkan');
            }

            $createTrans = [
                'no'                  => $this->gen_number($this->model, 'no', 'TR$$-@@#####', date('Y-m-d'), 'tanggal', true),
                'tanggal'             => date('Y-m-d'),
                'customer_id'         => auth()->user()->id,
                'jenis_pengiriman_id' => $data['jenis_pengiriman_id'],
                'text'                => $data['text'],
                'provinsi_id'         => $data['provinsi_id'],
                'kabupaten_id'        => $data['kabupaten_id'],
                'kecamatan_id'        => $data['kecamatan_id'],
                'kelurahan_id'        => $data['kelurahan_id'],
                'alamat'              => $data['alamat'],
                'status'              => 'open',
            ];

            $model = $this->model->create($createTrans);

            if ($request->hasFile('bukti_pengiriman')) {
                $filename = $this->saveFoto($request->bukti_pengiriman, 'bukti_pengiriman/' . $model->id);
                $model->update(['bukti' => $filename]);
            }

            $cartToLines = CartMerch::where('created_by', auth()->user()->id)
                ->get()
                ->map(function ($cart) use ($model) {
                    return [
                        'trans_id' => $model->id,
                        'merch_id' => $cart->merch_id,
                        'size'     => $cart->merch->size,
                        'qty'      => $cart->qty,
                        'harga'    => $cart->merch->harga,
                    ];
                })
                ->toArray();

            if (!empty($cartToLines)) {
                TransLine::insert($cartToLines);
                CartMerch::where('created_by', auth()->user()->id)->delete();
            }

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

    //REGISTER
    public function register(Request $request)
    {
        $view  = [
            'title'     => 'Register',
            'subtitle'  => 'Register',
        ];
        return view($this->generateViewName('register'))->with($view);
    }


    public function registerStore(Request $request)
    {
        try {

            DB::beginTransaction();

            $data  = $this->getRequest();

            $validator                  = Validator::make($request->all(), [
                'username'              => 'required|unique:users,username',
                'name'                  => 'required',
                'email'                 => 'required|email|unique:users,email',
                'nowa'                  => 'required',
                'password'              => 'required',
            ], [
                'username.required' => 'Username harus diisi.',
                'username.unique' => 'Username sudah terdaftar.',
                'name.required' => 'Nama Lengkap harus diisi.',
                'email.required' => 'Email harus diisi.',
                'email.email' => 'Email must be a valid email address.',
                'email.unique' => 'Email sudah terdaftar.',
                'nowa.required' => 'Whatsapp harus diisi.',
                'password.required' => 'Password harus diisi.',
            ]);

            if ($validator->fails()) {
                $response           = [
                    'status'            => false,
                    'msg'               => $validator->messages()->first(),
                ];
                return response()->json($response);
            }


            $model = $this->user->fill($data);
            $model->save();

            $model->assignRole('GUEST');

            $log_helper     = new LogHelper;

            $log_helper->storeLog('add', $model->no ?? $model->id, $this->subtitle);

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
}
