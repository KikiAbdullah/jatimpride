<?php

namespace App\Http\Controllers;

use App\Helpers\LogHelper;
use App\Mail\FileMail;
use App\Models\CartMerch;
use App\Models\Master\Activity;
use App\Models\Master\Crew;
use App\Models\Master\Event;
use App\Models\Master\Merch;
use App\Models\Master\Sponsor;
use App\Models\Trans;
use App\Models\TransLine;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;
use Exception;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class FrontController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check()) {
            if (auth()->user()->roles->first()->name == 'SUPERADMIN') {
                return redirect()->route('siteurl');
            }
        }

        $data = [
            'title' => 'index',
            'event' => Event::orderBy('urutan')->get(),
            'activity' => Activity::orderBy('urutan')->get(),
            'sponsor_utama' => Sponsor::orderBy('urutan')->limit(3)->get(),
            // 'sponsor' => Sponsor::orderBy('urutan')->offset(3)->limit(PHP_INT_MAX)->get(), // Use a large number to get all remaining records
            'sponsor' => Sponsor::orderBy('urutan')->get(), // Use a large number to get all remaining records
        ];

        return view('front.index', $data);
    }

    public function merchandise(Request $request)
    {
        if (Auth::check()) {
            if (auth()->user()->roles->first()->name == 'SUPERADMIN') {
                return redirect()->route('siteurl');
            }
        }

        $merch = Merch::all();

        $data = [
            'title' => 'merchandise',
            'item' => (clone $merch)->first(),
            'list_size' => implode(', ', (clone $merch)->pluck('size', 'size')->toArray()),
            'harga' => 'Rp ' . cleanNumber((clone $merch)->min('harga')) . ' - Rp ' . cleanNumber((clone $merch)->max('harga')),
        ];

        return view('front.merchandise', $data);
    }

    public function crew(Request $request)
    {
        if (Auth::check()) {
            if (auth()->user()->roles->first()->name == 'SUPERADMIN') {
                return redirect()->route('siteurl');
            }
        }

        $data = [
            'title' => 'crew',
        ];

        return view('front.crew', $data);
    }

    //REGISTER
    public function register(Request $request)
    {
        $view  = [
            'title'     => 'Register',
            'subtitle'  => 'Register',
        ];
        return view('front.register')->with($view);
    }


    public function registerStore(Request $request)
    {
        try {

            DB::beginTransaction();

            $data  = $request->all();

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


            $model = User::create($data);

            $model->assignRole('GUEST');

            $log_helper     = new LogHelper;

            $log_helper->storeLogCustomMessage('Registrasi berhasil akun <b>GUEST</b> dengan nama <b>' . $model->name . '/' . $model->id . '</b>', 'add');

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
    //REGISTER

    //PROFILE
    public function profile(Request $request)
    {
        if (Auth::check()) {
            if (auth()->user()->roles->first()->name == 'SUPERADMIN') {
                return redirect()->route('siteurl');
            }
        }

        $data = [
            'title' => 'Profile',
            'data'  => [
                'history'   => Trans::with(['lines'])->where('customer_id', auth()->user()->id)->orderBy('id', 'desc')->get(),
            ]
        ];

        return view('front.profile', $data);
    }

    public function history(Request $request, $id)
    {
        if (Auth::check()) {
            if (auth()->user()->roles->first()->name == 'SUPERADMIN') {
                return redirect()->route('siteurl');
            }
        }

        $data = [
            'title' => 'Order',
            'item'  => Trans::find($id),
            'data'  => []
        ];

        return view('front.history', $data);
    }
    //PROFILE


    //ORDER
    public function order(Request $request)
    {
        if (Auth::check()) {
            if (auth()->user()->roles->first()->name == 'SUPERADMIN') {
                return redirect()->route('siteurl');
            }
        }

        $data = [
            'title' => 'Order',
            'data'  => [
                'merch'                     => Merch::all(),
                'list_jenis_pengiriman'     => $this->listJenisPengiriman(),
                'list_provinsi'             => $this->listProvinsi(),
            ]
        ];

        return view('front.order', $data);
    }

    public function orderStore(Request $request)
    {
        try {
            DB::beginTransaction();

            $response = responseFailed();

            $data = $request->all();

            if (!empty($data['merch'])) {
                foreach ($data['merch'] as $item) {
                    $merch = Merch::find($item['id']);

                    // Validate quantity
                    if ($item['qty'] > $merch->stok) {
                        return response()->json([
                            'status' => false,
                            'msg'    => 'Maks. Pembelian barang ini ' . $merch->stok . ', kurangi pembelianmu, ya!',
                        ]);
                    }

                    // Update cart item quantity
                    $model = CartMerch::updateOrCreate(
                        [
                            'created_by' =>  auth()->user()->id,
                            'merch_id'   => $item['id'],
                        ],
                        [
                            'qty' => DB::raw('COALESCE(qty, 0) + ' . $item['qty']),
                        ]
                    );
                }

                $response = responseSuccess();
            }


            DB::commit();

            return response()->json($response);
        } catch (Exception $e) {
            DB::rollback();

            $response = responseFailed($e->getMessage());
            return response()->json($response);
        }
    }

    public function payment(Request $request)
    {
        if (Auth::check()) {
            if (auth()->user()->roles->first()->name == 'SUPERADMIN') {
                return redirect()->route('siteurl');
            }
        }

        $data = [
            'title' => 'Payment',
            'data'  => [
                'cart'                      => CartMerch::with(['merch'])->where('created_by', auth()->user()->id)->get(),
                'list_jenis_pengiriman'     => $this->listJenisPengiriman(),
                'list_provinsi'             => $this->listProvinsi(),
            ]
        ];

        return view('front.payment', $data);
    }

    public function paymentStore(Request $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->all();

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
                'no'                  => $this->gen_number(Trans::class, 'no', 'TR$$-@@#####', date('Y-m-d'), 'tanggal', true),
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
            $model = Trans::create($createTrans);

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
            return redirect()->route('front.history', $model->id)
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
    //ORDER
}
