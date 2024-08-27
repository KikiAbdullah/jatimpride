<?php

namespace App\Http\Controllers\Master;

use App\Helpers\LogHelper;
use App\Http\Controllers\Controller;
use App\Models\Master\FgSupport;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use DB;
use Exception;

class FgSupportController extends Controller
{
    public function __construct(FgSupport $model)
    {
        $this->title            = 'FG Support';
        $this->subtitle         = 'FG Support List';
        $this->model_request    = Request::class;
        $this->folder           = 'master';
        $this->relation         = [];
        $this->model            = $model;
        $this->withTrashed      = false;
    }

    public function ajaxData()
    {
        if ($this->withTrashed) {
            $mapped             = $this->model->with($this->relation)->withTrashed()->orderBy('id', 'desc');
        } else {
            $mapped             = $this->model->with($this->relation)->orderBy('id', 'desc');
        }
        return DataTables::of($mapped)
            ->editColumn('foto', function ($data) {
                return '<center><img src="' . $data->foto_url . '" class="img-fluid" style="max-height:50px;" alt=""></center>';
            })
            ->rawColumns(['foto'])
            ->toJson();
    }

    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            $data  = $this->getRequest();

            if ($request->hasFile('foto')) {
                unset($data['foto']);
            }

            $model = $this->model->fill($data);

            $model->save();


            if ($request->hasFile('foto')) {
                $filename = $this->saveFoto($request->foto, 'fg');
                $model->foto = $filename;
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

    public function update(Request $request, $id)
    {
        try {

            DB::beginTransaction();

            $data  = $this->getRequest();

            if ($request->hasFile('foto')) {
                unset($data['foto']);
            }

            $model = $this->model->findOrFail($id);

            $model->fill($data);

            $model->save();


            if (empty($data['file_exist'])) {
                $model->foto = null;
                $model->save();
            }

            if ($request->hasFile('foto')) {
                $filename = $this->saveFoto($request->foto, 'fg');
                $model->foto = $filename;
                $model->save();
            }

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
