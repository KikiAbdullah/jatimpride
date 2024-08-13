<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Merch;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

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
            ->toJson();
    }
}
