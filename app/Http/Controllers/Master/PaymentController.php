<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Payment;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PaymentController extends Controller
{
    public function __construct(Payment $model)
    {
        $this->title            = 'Payment';
        $this->subtitle         = 'Payment List';
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
