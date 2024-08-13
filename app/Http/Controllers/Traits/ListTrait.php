<?php

namespace App\Http\Controllers\Traits;

use App\Models\Master\Kabupaten;
use App\Models\Master\Kecamatan;
use App\Models\Master\Kelurahan;
use App\Models\Master\Provinsi;
use DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

trait ListTrait
{

    public function list_role()
    {
        return Role::pluck('name', 'id');
    }


    public function listProvinsi()
    {
        $provinsi = Provinsi::pluck('nama_provinsi', 'id');

        return $provinsi;
    }

    public function listKota(Request $request)
    {
        $kabupaten = Kabupaten::where('provinsi_id', $request->id)->pluck('nama_kabupaten', 'id');

        return response()->json($kabupaten);
    }

    public function listKecamatan(Request $request)
    {
        $kecamatan = Kecamatan::where('kabupaten_id', $request->id)->pluck('nama_kecamatan', 'id');

        return response()->json($kecamatan);
    }

    public function listKelurahan(Request $request)
    {
        $kelurahan = Kelurahan::where('kecamatan_id', $request->id)->pluck('nama_kelurahan', 'id');

        return response()->json($kelurahan);
    }

    public function listKabupatenByModel($model)
    {
        return Kabupaten::where('provinsi_id', $model->provinsi_id)->pluck('nama_kabupaten', 'id');
    }

    public function listKecamatanByModel($model)
    {
        return Kecamatan::where('kabupaten_id', $model->kabupaten_id)->pluck('nama_kecamatan', 'id');
    }

    public function listKelurahanByModel($model)
    {
        return Kelurahan::where('kecamatan_id', $model->kecamatan_id)->pluck('nama_kelurahan', 'id');
    }
}
