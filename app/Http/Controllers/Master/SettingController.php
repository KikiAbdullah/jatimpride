<?php

namespace App\Http\Controllers\Master;

use App\Helpers\LogHelper;
use App\Http\Controllers\Controller;
use App\Models\Master\Setting;
use Illuminate\Http\Request;
use DB;

class SettingController extends Controller
{
    public function __construct(Setting $model)
    {
        $this->title            = 'Setting';
        $this->subtitle         = 'Setting';
        $this->model_request    = Request::class;
        $this->folder           = 'master';
        $this->relation         = [];
        $this->model            = $model;
        $this->withTrashed      = false;
    }

    public function update(Request $request, $id)
    {

        try {

            DB::beginTransaction();

            $data  = $this->getRequest();

            if ($this->withTrashed) {
                $model = $this->model->withTrashed()->findOrFail($id);
            } else {
                $model = $this->model->findOrFail($id);
            }

            $model->fill($data);

            $model->save();

            //file
            if (empty($data['icon_exist'])) {
                $model->icon = null;
                $model->save();
            }

            if ($request->hasFile('icon')) {
                $filename = $this->saveFoto($request->icon, 'icon');
                $model->icon = $filename;
                $model->save();
            }

            if (empty($data['logo_exist'])) {
                $model->logo = null;
                $model->save();
            }

            if ($request->hasFile('logo')) {
                $filename = $this->saveFoto($request->logo, 'logo');
                $model->logo = $filename;
                $model->save();
            }

            if (empty($data['event_logo_exist'])) {
                $model->event_logo = null;
                $model->save();
            }

            if ($request->hasFile('event_logo')) {
                $filename = $this->saveFoto($request->event_logo, 'event_logo');
                $model->event_logo = $filename;
                $model->save();
            }

            if (empty($data['about_foto_exist'])) {
                $model->about_foto = null;
                $model->save();
            }

            if ($request->hasFile('about_foto')) {
                $filename = $this->saveFoto($request->about_foto, 'about_foto');
                $model->about_foto = $filename;
                $model->save();
            }

            if (empty($data['merch_foto_1_exist'])) {
                $model->merch_foto_1 = null;
                $model->save();
            }

            if ($request->hasFile('merch_foto_1')) {
                $filename = $this->saveFoto($request->merch_foto_1, 'merch_foto');
                $model->merch_foto_1 = $filename;
                $model->save();
            }

            if (empty($data['merch_foto_2_exist'])) {
                $model->merch_foto_2 = null;
                $model->save();
            }

            if ($request->hasFile('merch_foto_2')) {
                $filename = $this->saveFoto($request->merch_foto_2, 'merch_foto');
                $model->merch_foto_2 = $filename;
                $model->save();
            }
            //file

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
                return redirect()->route($this->generateUrl('edit'), 1)
                    ->withSuccess('Data Saved Successfully');
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
