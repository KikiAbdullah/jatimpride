<?php

namespace App\Http\Controllers;

use App\Models\Trans;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use DB;
use App\Mail\FileMail;
use Illuminate\Support\Facades\Mail;

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
        $this->withTrashed      = true;
    }

    public function buttonOption(Request $request)
    {
        $btn            = [];
        $data           = $request->all();

        $model          = $this->model->find($request->id);


        switch ($model->status) {
            case 'open':
                $btn['edit']                = $this->generateUrl('edit');
                $btn['destroy']             = $this->generateUrl('destroy');

                $btn['confirm-view']             = $this->generateUrl('confirm-view');
                $btn['rejected']          = $this->generateUrl('rejected');
                break;


            case 'confirm':
                $btn['unconfirm']       = $this->generateUrl('unconfirm');
                $btn['closed']          = $this->generateUrl('closed');
                $btn['rejected']          = $this->generateUrl('rejected');
                break;

            case 'closed':
                $btn['unclosed']    = $this->generateUrl('unclosed');
                break;

            case 'rejected':
                $btn['unrejected']    = $this->generateUrl('unrejected');
                break;
        }
        $btn['show']                = $this->generateUrl('show');

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
                $filePath = storage_path('app/public/sample.pdf'); // Ganti dengan path file kamu
                $subject = "Konfirmasi Pemesanan";
                $email = Mail::to($model->customer->email)->send(new FileMail($subject, $filePath, $model));
            }


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

            $model           = $this->model->find($id);

            $model->update([
                'status' => 'open',
                'confirm_by' => null,
                'confirm_at' => null,

            ]);
            $response           = [];

            DB::commit();

            return response()->json(responseSuccess('Berhasil', $response));
        } catch (Exception $e) {

            DB::rollback();

            return response()->json($e->getMessage());
        }
    }

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
            $response           = [];

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

            DB::commit();

            return response()->json(responseSuccess('Berhasil', $response));
        } catch (Exception $e) {

            DB::rollback();

            return response()->json($e->getMessage());
        }
    }

    public function rejected(Request $request, $id)
    {
        try {

            DB::beginTransaction();

            $data = $request->all();

            $model           = $this->model->find($id);

            $model->update([
                'status' => 'rejected',
                'text_reject' => $data['text_reject'],
                'rejected_by' => auth()->user()->id,
                'rejected_at' => date('Y-m-d H:i:s'),

            ]);
            $response           = [];

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

            DB::commit();

            return response()->json(responseSuccess('Berhasil', $response));
        } catch (Exception $e) {

            DB::rollback();

            return response()->json($e->getMessage());
        }
    }
}
