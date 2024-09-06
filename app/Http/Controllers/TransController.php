<?php

namespace App\Http\Controllers;

use App\Helpers\LogHelper;
use App\Models\Trans;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use DB;
use App\Mail\FileMail;
use App\Models\Master\Merch;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class TransController extends Controller
{
    public function __construct(Trans $model)
    {
        $this->title            = 'Trans';
        $this->subtitle         = 'Trans List';
        $this->model_request    = Request::class;
        $this->folder           = '';
        $this->relation         = ['customer', 'lines', 'jenisPengiriman', 'payment'];
        $this->model            = $model;
        $this->withTrashed      = false;
    }

    public function formData()
    {
        return [
            'list_merch' => $this->listMerch(),
        ];
    }

    public function buttonOption(Request $request)
    {
        $btn            = [];
        $data           = $request->all();

        $model          = $this->model->find($request->id);


        switch ($model->status) {
            case 'open':
                $btn['resend']                = $this->generateUrl('resend');

                $btn['edit']                = $this->generateUrl('edit');
                $btn['destroy']             = $this->generateUrl('destroy');

                $btn['confirm-view']             = $this->generateUrl('confirm-view');
                $btn['rejected']          = $this->generateUrl('rejected');
                break;


            case 'confirm':
                $btn['resend']                = $this->generateUrl('resend');

                $btn['unconfirm']       = $this->generateUrl('unconfirm');
                $btn['closed']          = $this->generateUrl('closed');
                $btn['rejected']          = $this->generateUrl('rejected');
                break;

            case 'closed':
                $btn['resend']                = $this->generateUrl('resend');

                $btn['unclosed']    = $this->generateUrl('unclosed');
                break;

            case 'rejected':
                $btn['resend']                = $this->generateUrl('resend');

                $btn['unrejected']    = $this->generateUrl('unrejected');
                break;
        }
        $btn['show']                = $this->generateUrl('show');
        $btn['print']               = $this->generateUrl('print');


        $view         = [
            'status'             => true,
            'view'                 => view($this->generateViewName('button_option'))->with(['id' => $data['id'], 'url' => $btn])->render()
        ];

        return response()->json($view);
    }

    public function ajaxData()
    {
        if ($this->withTrashed) {
            $mapped             = $this->model->with($this->relation)->withTrashed()->orderBy('id', 'desc');
        } else {
            $mapped             = $this->model->with($this->relation)->orderBy('id', 'desc');
        }
        return DataTables::of($mapped)
            ->addColumn('tanggal_formatted', function ($data) {
                return formatDate('Y-m-d', 'd/m/Y', $data->tanggal);
            })
            ->addColumn('customer_name', function ($data) {
                return $data->customer->name ?? "";
            })
            ->addColumn('jenis_pengiriman_name', function ($data) {
                return $data->jenisPengiriman->name ?? "";
            })
            ->addColumn('total', function ($data) {
                return cleanNumber($data->lines->sum('total'));
            })
            ->addColumn('status_formatted', function ($data) {
                return $data->status_formatted;
            })
            ->rawColumns(['status_formatted'])
            ->toJson();
    }

    public function formCreate(Request $request)
    {
        $view['form']   = $this->generateViewName('form');

        $view['url']    = [
            'store'         => $this->generateUrl('store')
        ];

        $view['data']   = [
            'list_jenis_pengiriman' => $this->listJenisPengiriman(),
            'list_provinsi'         => $this->listProvinsi(),
            'list_merch'            => $this->listMerch(),
        ];

        $response       = [
            'status'            => true,
            'view'              => view($this->generateViewName('create'))->with($view)->render(),
        ];

        return response()->json($response);
    }

    ///confirmView 
    public function confirmView(Request $request, $id)
    {
        $model = $this->model->with($this->relation)->findOrFail($id);

        $view = [
            'id'            => $id,
            'item'            => $model,
            'url'            => $this->generateUrl('confirm'),
        ];

        $response           = [
            'status'            => true,
            'view'              => view($this->generateViewName('confirm-view'))->with($view)->render(),
        ];
        return response()->json($response);
    }

    public function confirm(Request $request, $id)
    {
        try {

            DB::beginTransaction();

            $model           = $this->model->with($this->relation)->find($id);

            $model->update([
                'status' => 'confirm',
                'confirm_by' => auth()->user()->id,
                'confirm_at' => date('Y-m-d H:i:s'),

            ]);
            $response           = [];

            if (!empty($model->customer->email)) {
                $pdfName = $this->makePdfInvoice($model);
                $filePath = 'invoice/' . $model->id . '/' . $pdfName;

                Mail::to($model->customer->email)->send(new FileMail($filePath, $model));
            }

            $log_helper     = new LogHelper;

            $log_helper->storeLog('confirm', $model->id, $this->subtitle);


            DB::commit();

            return response()->json(responseSuccess('Berhasil', $response));
        } catch (Exception $e) {

            DB::rollback();

            return response()->json($e->getMessage());
        }
    }

    public function unconfirm(Request $request, $id)
    {
        try {

            DB::beginTransaction();

            $model           = $this->model->with($this->relation)->find($id);

            $model->update([
                'status' => 'open',
                'confirm_by' => null,
                'confirm_at' => null,

            ]);
            $response           = [];

            $log_helper     = new LogHelper;

            $log_helper->storeLog('unconfirm', $model->id, $this->subtitle);


            DB::commit();

            return response()->json(responseSuccess('Berhasil', $response));
        } catch (Exception $e) {

            DB::rollback();

            return response()->json($e->getMessage());
        }
    }
    ///confirm

    //closed
    public function closed(Request $request, $id)
    {
        try {

            DB::beginTransaction();

            $data = $request->all();

            $model           = $this->model->find($id);

            $model->update([
                'status' => 'closed',
                'noresi' => $model->jenis_pengiriman_id == 1 ? $data['noresi'] : '',
                'closed_by' => auth()->user()->id,
                'closed_at' => date('Y-m-d H:i:s'),

            ]);

            if (!empty($model->customer->email)) {
                $pdfName = $this->makePdfInvoice($model);
                $filePath = 'invoice/' . $model->id . '/' . $pdfName;
                Mail::to($model->customer->email)->send(new FileMail($filePath, $model));
            }

            $response           = [];

            $log_helper     = new LogHelper;

            $log_helper->storeLog('closed', $model->id, $this->subtitle);


            DB::commit();

            return response()->json(responseSuccess('Berhasil', $response));
        } catch (Exception $e) {

            DB::rollback();

            return response()->json($e->getMessage());
        }
    }

    public function unclosed(Request $request, $id)
    {
        try {

            DB::beginTransaction();

            $model           = $this->model->find($id);

            $model->update([
                'status' => 'confirm',
                'closed_by' => null,
                'closed_at' => null,

            ]);
            $response           = [];

            $log_helper     = new LogHelper;

            $log_helper->storeLog('unclosed', $model->id, $this->subtitle);

            DB::commit();

            return response()->json(responseSuccess('Berhasil', $response));
        } catch (Exception $e) {

            DB::rollback();

            return response()->json($e->getMessage());
        }
    }
    //closed

    //rejected
    public function rejected(Request $request, $id)
    {
        try {

            DB::beginTransaction();

            $data = $request->all();

            $model           = $this->model->with(['lines'])->find($id);

            $model->update([
                'status' => 'rejected',
                'text_reject' => $data['text_reject'],
                'rejected_by' => auth()->user()->id,
                'rejected_at' => date('Y-m-d H:i:s'),
            ]);


            //stok update 
            foreach ($model->lines as $key => $line) {
                $merch = Merch::find($line->merch_id);
                $merch->increment('stok', $line->qty);
            }

            if (!empty($model->customer->email)) {
                $filePath = '';

                $email = Mail::to($model->customer->email)->send(new FileMail($filePath, $model));
            }

            $response           = [];

            $log_helper     = new LogHelper;

            $log_helper->storeLog('rejected', $model->id, $this->subtitle);

            DB::commit();

            return response()->json(responseSuccess('Berhasil', $response));
        } catch (Exception $e) {

            DB::rollback();

            return response()->json($e->getMessage());
        }
    }

    public function unrejected(Request $request, $id)
    {
        try {

            DB::beginTransaction();

            $model           = $this->model->find($id);

            $model->update([
                'status' => 'open',
                'rejected_by' => null,
                'rejected_at' => null,

            ]);
            $response           = [];

            $log_helper     = new LogHelper;

            $log_helper->storeLog('unrejected', $model->id, $this->subtitle);

            DB::commit();

            return response()->json(responseSuccess('Berhasil', $response));
        } catch (Exception $e) {

            DB::rollback();

            return response()->json($e->getMessage());
        }
    }
    //rejected

    ///RESEND EMAIL
    public function resend(Request $request, $id)
    {
        $response           = [];

        $model           = $this->model->with($this->relation)->find($id);
        $filePath = '';
        if (!empty($model)) {
            if (!empty($model->customer->email)) {

                $pdfName = $this->makePdfInvoice($model);
                $filePath = 'invoice/' . $model->id . '/' . $pdfName;

                Mail::to($model->customer->email)->send(new FileMail($filePath, $model));

                return response()->json(responseSuccess('Berhasil', $response));
            }
        } else {
            return response()->json(responseFailed());
        }
    }
    ///RESEND EMAIL


    ///PRINT PDF
    public function print(Request $request, $id)
    {
        $response           = [];

        $model           = $this->model->with($this->relation)->find($id);

        if (!empty($model)) {

            $data['item']           = $model;

            $pdf                    = Pdf::loadView('trans.print', $data);
            return $pdf->stream();
        } else {
            return response()->json(responseFailed());
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
    ///PRINT PDF
}
