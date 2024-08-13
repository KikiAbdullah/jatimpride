<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\CartMerch;
use App\Models\Master\JenisPengiriman;
use App\Models\Master\Merch;
use App\Models\Trans;
use App\Models\TransLine;
use Illuminate\Http\Request;
use DB;
use Exception;

class MobileWebController extends Controller
{
    public function __construct(Trans $model)
    {
        $this->title            = 'Mobile';
        $this->subtitle         = 'Mobile';
        $this->model_request    = Request::class;
        $this->folder           = '';
        $this->relation         = ['customer', 'lines', 'jenisPengiriman', 'payment'];
        $this->model            = $model;
        $this->withTrashed      = true;
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

    public function productDetail(Request $request)
    {
        $merch = Merch::get();

        $view  = [
            'title'     => $this->title,
            'subtitle'  => $this->subtitle,
            'data'      => [
                'size' => $merch->pluck('size', 'id'),
            ],
            'item'      => (clone $merch)->first(),

        ];
        return view($this->generateViewName('product-detail'))->with($view);
    }

    public function history(Request $request)
    {
        $view  = [
            'title'     => $this->title,
            'subtitle'  => $this->subtitle,
            'data'      => [],
            'items'     => $this->model->with(['lines'])->where('customer_id', auth()->user()->id)->get(),
        ];
        return view($this->generateViewName(__FUNCTION__))->with($view);
    }

    ///cart
    public function cart(Request $request)
    {
        $carts = CartMerch::with(['merch'])->where('created_by', auth()->user()->id)->get();

        $view  = [
            'title'     => $this->title,
            'subtitle'  => $this->subtitle,
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

    public function cartStore(Request $request)
    {
        try {
            DB::beginTransaction();

            $data  = $this->getRequest();

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

            $data  = $this->getRequest();


            $createTrans = [
                'no' => $this->gen_number($this->model, 'no', 'TR$$-@@#####', date('Y-m-d'), 'tanggal', true),
                'tanggal' => date('Y-m-d'),
                'customer_id' => auth()->user()->id,
                'jenis_pengiriman_id' => $data['jenis_pengiriman_id'],
                'text' => $data['text'],
                'provinsi_id' => $data['provinsi_id'],
                'kabupaten_id' => $data['kabupaten_id'],
                'kecamatan_id' => $data['kecamatan_id'],
                'kelurahan_id' => $data['kelurahan_id'],
                'alamat' => $data['alamat'],
                'status' => 'open',
            ];

            $model = $this->model->create($createTrans);

            if ($request->hasFile('bukti_pengiriman')) {
                $filename = $this->saveFoto($request->bukti_pengiriman, 'bukti_pengiriman/' . $model->id);
                $model->bukti = $filename;
                $model->save();
            }

            $cartToLines = [];

            $carts = CartMerch::where('created_by', auth()->user()->id)->get();
            foreach ($carts as  $cart) {
                $cartToLines[] = [
                    'trans_id' => $model->id,
                    'merch_id' => $cart->merch_id,
                    'size' => $cart->merch->size,
                    'qty'  => $cart->qty,
                    'harga' => $cart->merch->harga,
                ];
            }

            if (!empty($cartToLines)) {
                TransLine::insert($cartToLines);
            }

            DB::commit();

            return redirect()->route($this->generateUrl('history'))
                ->withSuccess('Pemesanan Telah Berhasil');
        } catch (Exception $e) {

            DB::rollback();

            return $this->redirectBackWithError($e->getMessage());
        }
    }
}
