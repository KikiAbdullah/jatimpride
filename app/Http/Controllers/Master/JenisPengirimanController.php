<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\JenisPengiriman;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class JenisPengirimanController extends Controller
{
    public function __construct(JenisPengiriman $model)
    {
        $this->title            = 'Jenis Pengiriman';
        $this->subtitle         = 'Jenis Pengiriman List';
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
            ->toJson();
    }
}
