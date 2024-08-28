@extends('layouts.header')
@section('customcss')
@endsection

@section('customjs')
@endsection

@section('content')
    <!-- Page header -->
    <div class="page-header">
        <div class="page-header-content container d-lg-flex">
            <div class="d-flex">
                <h4 class="page-title mb-1">
                </h4>

                <a href="#page_header"
                    class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto"
                    data-bs-toggle="collapse">
                    <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
                </a>
            </div>

        </div>
    </div>
    <!-- /page header -->


    <!-- Content area -->
    <div class="content container pt-0">

        <div class="row">
            <div class="col-lg-12">
                <div class="card p-3" style="border-radius: 25px !important;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3 col-sm-6">
                                <div class="d-flex align-items-center mb-3 mb-lg-0">
                                    <a href="#" class="bg-primary bg-opacity-10 text-primary lh-1 rounded-pill p-2">
                                        <i class="ph ph-info ph-2x"></i>
                                    </a>
                                    <div class="ms-3">
                                        <h5 class="mb-0">{{ $total['open'] ?? 0 }} Transaksi</h5>
                                        <span class="text-muted">Menunggu Konfirmasi</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="d-flex align-items-center mb-3 mb-lg-0">
                                    <a href="#" class="bg-success bg-opacity-10 text-success lh-1 rounded-pill p-2">
                                        <i class="ph ph-check-circle ph-2x"></i>
                                    </a>
                                    <div class="ms-3">
                                        <h5 class="mb-0">{{ $total['confirm'] ?? 0 }} Transaksi</h5>
                                        <span class="text-muted">Dikonfirmasi</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">

                                <div class="d-flex align-items-center mb-3 mb-lg-0">
                                    <a href="#" class="bg-success bg-opacity-10 text-success lh-1 rounded-pill p-2">
                                        <i class="ph ph-circle-wavy-check ph-2x"></i>
                                    </a>
                                    <div class="ms-3">
                                        <h5 class="mb-0">{{ $total['closed'] ?? 0 }} Transaksi</h5>
                                        <span class="text-muted">Selesai</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="d-flex align-items-center mb-3 mb-lg-0">
                                    <a href="#" class="bg-danger bg-opacity-10 text-danger lh-1 rounded-pill p-2">
                                        <i class="ph ph-x-circle ph-2x"></i>
                                    </a>
                                    <div class="ms-3">
                                        <h5 class="mb-0">{{ $total['rejected'] ?? 0 }} Transaksi</h5>
                                        <span class="text-muted">Dibatalkan</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h5 class="mb-0">Sisa Stok</h5>

                        <div class="d-inline-flex ms-auto">
                            <a href="{{ route('master.merch.index') }}" class="btn btn-primary">
                                <i class="ph-t-shirt  me-2"></i>
                                Edit Stok
                            </a>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table text-nowrap">
                            <tbody>
                                @foreach ($merches as $merch)
                                    <tr>
                                        <td>

                                            <span
                                                class="d-inline-block {{ $merch->stok > 10 ? 'bg-success' : 'bg-danger' }} rounded-pill p-1 me-1"></span>
                                            {{ $merch->name_size }}
                                        </td>
                                        <td class="text-end">
                                            <h6 class="mb-0">{{ cleanNumber($merch->stok) }} Pcs</h6>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h5 class="mb-0">Recent Activity</h5>
                    </div>

                    <div class="card-body">
                        @foreach ($userlog as $log)
                            <div class="d-flex mb-3">
                                <div class="me-3">
                                    {!! $log->action_formatted !!}
                                </div>
                                <div class="flex-fill">
                                    {!! $log->message ?? '' !!}
                                    <div class="text-muted fs-sm">{{ $log->created_at }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /content area -->
@endsection
@section('notification')
    @include('layouts.notification')
@endsection
