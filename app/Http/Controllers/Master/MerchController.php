<?php

namespace App\Http\Controllers\Master;

use App\Helpers\LogHelper;
use App\Http\Controllers\Controller;
use App\Models\Master\Merch;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use DB;

class MerchController extends Controller
{
    public function __construct(Merch $model)
    {
        $this->title            = 'Merch';
        $this->subtitle         = 'Merch List';
        $this->model_request    = Request::class;
        $this->folder           = 'master';
        $this->relation         = [];
        $this->model            = $model;
        $this->withTrashed      = true;
    }

    public function ajaxData()
    {
        if ($this->withTrashed) {
            $mapped             = $this->model->with($this->relation)->withTrashed()->orderBy('id', 'desc');
        } else {
            $mapped             = $this->model->with($this->relation)->orderBy('id', 'desc');
        }
        return DataTables::of($mapped)
            ->editColumn('thumbnail', function ($data) {
                return '<center><img src="' . $data->thumb_mobile . '" class="img-fluid" style="max-height:50px;" alt=""></center>';
            })
            ->editColumn('harga', function ($data) {
                return cleanNumber($data->harga);
            })
            ->rawColumns(['thumbnail'])
            ->toJson();
    }

    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            $data  = $this->getRequest();

            if ($request->hasFile('thumbnail')) {
                unset($data['thumbnail']);
            }

            $model = $this->model->fill($data);

            $model->save();


            if ($request->hasFile('thumbnail')) {
                $filename = $this->saveFoto($request->thumbnail, 'thumbnail/' . $model->id);
                $model->thumbnail = $filename;
                $model->save();
            }

            $log_helper     = new LogHelper;

            $log_helper->storeLog('add', $model->no ?? $model->id, $this->subtitle);

            DB::commit();
            if ($request->ajax()) {
                $response           = [
                    'status'            => true,
                    'msg'               => 'Data Saved.',
                ];
                return response()->json($response);
            } else {
                return $this->redirectSuccess(__FUNCTION__, false);
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
