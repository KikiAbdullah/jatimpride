@extends('layouts.header')

@section('customcss')
@endsection

@section('content')
    <!-- Page header -->
    <div class="page-header">
        <div class="page-header-content d-lg-flex">
            <div class="d-flex">
                <h4 class="page-title mb-0">
                </h4>

                <a href="#page_header"
                    class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto"
                    data-bs-toggle="collapse">
                    <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
                </a>
            </div>

            <div class="collapse d-lg-block my-lg-auto ms-lg-auto" id="page_header">
                <div class="hstack gap-0 mb-3 mb-lg-0">
                    <span class="menuoption"></span>
                    <a href="{{ route('trans.index') }}"
                        class="btn flex-column btn-float py-2 mx-2 text-uppercase text-dark fw-semibold"><i
                            class="ph-caret-left ph-2x text-warning"></i>Kembali</a>

                    @switch($item->status)
                        @case('open')
                            <a href="{{ route('trans.confirm', $id) }}" data-title="Konfirmasi" data-icon="question"
                                data-tipe="confirm"
                                class="btn flex-column btn-float py-2 mx-2 text-uppercase text-dark fw-semibold btnOption"><i
                                    class="ph-check-circle text-success"></i>Konfirmasi</a>

                            <a href="{{ route('trans.rejected', $id) }}" data-title="Reject" data-icon="question"
                                data-tipe="rejected"
                                class="btn flex-column btn-float py-2 mx-2 text-uppercase text-dark fw-semibold btnOption"><i
                                    class="ph-x-circle text-danger"></i>Reject</a>

                            {!! Form::open([
                                'route' => ['trans.destroy', $id],
                                'method' => 'DELETE',
                                'class' => 'delete',
                                'style' => 'display: contents',
                            ]) !!}
                            <a href="#"
                                class="btn flex-column btn-float py-2 mx-2 text-uppercase text-dark fw-semibold deleteBtn"><i
                                    class="ph-trash text-danger"></i>DELETE</a>
                            {!! Form::close() !!}
                        @break

                        @case('confirm')
                            <a href="{{ route('trans.unconfirm', $id) }}" data-title="Batal Konfirmasi" data-icon="question"
                                data-tipe="unconfirm"
                                class="btn flex-column btn-float py-2 mx-2 text-uppercase text-dark fw-semibold btnOption"><i
                                    class="ph-arrow-u-up-left  text-danger"></i>Batal Konfirmasi</a>

                            <a href="{{ route('trans.closed', $id) }}" data-title="Selesai" data-icon="question" data-tipe="closed"
                                class="btn flex-column btn-float py-2 mx-2 text-uppercase text-dark fw-semibold btnOption"><i
                                    class="ph-circle-wavy-check text-success"></i>Selesai</a>
                        @break

                        @case('closed')
                            <a href="{{ route('trans.unclosed', $id) }}" data-title="Batal Selesai" data-icon="question"
                                data-tipe="unclosed"
                                class="btn flex-column btn-float py-2 mx-2 text-uppercase text-dark fw-semibold btnOption"><i
                                    class="ph-arrow-u-up-left  text-danger"></i>Batal Selesai</a>
                        @break

                        @case('rejected')
                            <a href="{{ route('trans.unrejected', $id) }}" data-title="Batal Reject" data-icon="question"
                                data-tipe="unrejected"
                                class="btn flex-column btn-float py-2 mx-2 text-uppercase text-dark fw-semibold btnOption"><i
                                    class="ph-arrow-u-up-left text-indigo"></i>Batal Reject</a>
                        @break

                        @default
                    @endswitch

                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->


    <!-- Content area -->
    <div class="content pt-0">
        @include('layouts.alert')
        <div class="row">
            <div class="col-md-12">
                <!-- Card -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-indigo text-white d-flex align-items-center">
                                <div>
                                    <h6 class="mb-sm-0">
                                        Detail Transaksi
                                    </h6>
                                    <cite class="fs-sm mb-2"></cite>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row mb-1">
                                    <label
                                        class="col-lg-3 text-lg-end fw-normal text-muted form-custom-head">Tanggal</label>
                                    <div class="col-lg-9 mb-1">
                                        <div class="fw-semibold form-control-plaintext">
                                            {{ formatDate('Y-m-d H:i:s', 'd/m/Y H:i:s', $item->created_at) }}</div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <label class="col-lg-3 text-lg-end fw-normal text-muted form-custom-head">No</label>
                                    <div class="col-lg-9 mb-1">
                                        <div class="fw-semibold form-control-plaintext">{{ ucwords($item->no) }}</div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <label
                                        class="col-lg-3 text-lg-end fw-normal text-muted form-custom-head">Customer</label>
                                    <div class="col-lg-9 mb-1">
                                        <div class="fw-semibold form-control-plaintext">
                                            {{ ucwords($item->customer->name) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <label class="col-lg-3 text-lg-end fw-normal text-muted form-custom-head">Jenis
                                        Pengiriman</label>
                                    <div class="col-lg-9 mb-1">
                                        <div class="form-control-plaintext">
                                            {{ ucwords($item->jenisPengiriman->name) }}
                                        </div>
                                        <small><cite>{{ $item->jenisPengiriman->text }}</cite></small>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <label
                                        class="col-lg-3 text-lg-end fw-normal text-muted form-custom-head">Keterangan</label>
                                    <div class="col-lg-9 mb-1">
                                        <div class="form-control-plaintext">{{ $item->text }}</div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <label class="col-lg-3 text-lg-end fw-normal text-muted form-custom-head">Alamat</label>
                                    <div class="col-lg-9 mb-1">
                                        <div class="form-control-plaintext">{{ $item->alamat_prov }}</div>
                                        <div class="form-control-plaintext">{{ $item->alamat }}</div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <label class="col-lg-3 text-lg-end fw-normal text-muted form-custom-head">Status</label>
                                    <div class="col-lg-9 mb-1">
                                        <div class="form-control-plaintext">{!! $item->status_formatted !!}</div>
                                    </div>
                                </div>

                                <div class="row mb-1">
                                    <label class="col-lg-3 text-lg-end fw-normal text-muted form-custom-head">Bukti
                                        Pembayaran</label>
                                    <div class="col-lg-3 mb-1">
                                        <div class="card">
                                            <div class="card-img-actions m-1">
                                                <img class="card-img img-fluid" style="max-height: 300px;"
                                                    src="{{ asset('storage/bukti_pengiriman/' . $item->id . '/' . $item->bukti) }}"
                                                    alt="">
                                                <div class="card-img-actions-overlay card-img">
                                                    <a href="{{ asset('storage/bukti_pengiriman/' . $item->id . '/' . $item->bukti) }}"
                                                        class="btn btn-outline-white btn-icon rounded-pill"
                                                        data-bs-popup="lightbox" data-gallery="gallery1">
                                                        <i class="ph-magnifying-glass"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-indigo text-white d-flex align-items-center">
                                <div>
                                    <h6 class="mb-sm-0">
                                        Item Transaksi
                                    </h6>
                                    <cite class="fs-sm mb-2"></cite>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-xxs table-bordered" id="dtable">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th width="10%">Size</th>
                                            <th width="10%" class="text-end">Qty</th>
                                            <th width="20%" class="text-end">Harga [Rp]</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($item->lines as $line)
                                            <tr>
                                                <td>{{ $line->merch->name ?? '' }}</td>
                                                <td>{{ $line->size }}</td>
                                                <td class="text-end">{{ $line->qty }}</td>
                                                <td class="text-end">{{ cleanNumber($line->harga) }}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <th colspan="3" class="text-end">Total [Rp]</th>
                                            <th class="text-end">{{ cleanNumber ($item->lines->sum('total')) }}
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /card -->
            </div>
        </div>
    </div>
    <!-- /content area -->
@endsection

@section('customjs')
    <script src="{{ asset('assets/js/vendor/media/glightbox.min.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('body').on("click", '.btnOption', function(e) {
                e.preventDefault();

                const title = $(this).data('title');
                const url = $(this).attr('href');
                const icon = $(this).data('icon');
                const tipe = $(this).data('tipe');
                const msg = $(this).data('msg');

                let inputHtml = '';

                if (tipe === 'closed') {
                    inputHtml += `<input type="text" name="noresi" class="form-control mb-2 field-noresi" placeholder="Masukan Nomor Resi" autofocus>
                                <small><cite>Masukan Nomor Resi Apabila Dikirim melalui kurir</cite></small>`;

                } else if (tipe === 'rejected') {
                    inputHtml += `<input type="text" name="text_rejected" class="form-control mb-2 field-text-rejected" placeholder="Masukan Alasan Ditolak" autofocus>
                                <small><cite>Masukan alasan ditolak</cite></small>`;
                }

                swalInit.fire({
                    icon: icon,
                    title: title,
                    html: inputHtml || `Are you sure ${title}?`,
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    confirmButtonColor: 'red',
                    reverseButtons: true,
                    showLoaderOnConfirm: true,
                    didOpen: () => {
                        if (tipe == 'closed') {
                            textField = Swal.getPopup().querySelector(".field-noresi");
                            textField?.focus();

                        } else if (tipe == 'rejected') {
                            textField = Swal.getPopup().querySelector(
                                ".field-text-rejected");
                            textField?.focus();
                        }
                    },
                    preConfirm: () => {
                        const noresi = Swal.getPopup().querySelector(".field-noresi")
                            ?.value ||
                            '';
                        const textRejected = Swal.getPopup().querySelector(
                            ".field-text-rejected")?.value || '';

                        return $.ajax({
                                type: 'POST',
                                url: url,
                                data: tipe === 'closed' ? {
                                    noresi
                                } : tipe === 'rejected' ? {
                                    text_reject: textRejected
                                } : {},
                                dataType: "json",
                            }).done(data => data)
                            .fail(jqXHR => {
                                const xhr = JSON.stringify(JSON.parse(jqXHR.responseText));
                                swalInit.fire({
                                    title: 'Request Error',
                                    text: xhr.substring(0, 160),
                                    icon: 'error',
                                });
                            });
                    },
                    allowEscapeKey: false,
                    allowOutsideClick: false
                }).then(result => {
                    if (result.isConfirmed) {
                        if (result.value.status) {
                            swalInit.fire({
                                title: 'Success',
                                text: result.value.msg,
                                icon: 'success',
                            });
                            window.location.href = "";
                        } else {
                            swalInit.fire({
                                title: 'Error',
                                text: result.value.msg.substring(0, 160),
                                icon: 'error',
                            });
                        }
                    }
                });
            });

            GLightbox({
                selector: '[data-bs-popup="lightbox"]',
                loop: true,
                svg: {
                    next: document.dir == "rtl" ?
                        '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 477.175 477.175" xml:space="preserve"><g><path d="M145.188,238.575l215.5-215.5c5.3-5.3,5.3-13.8,0-19.1s-13.8-5.3-19.1,0l-225.1,225.1c-5.3,5.3-5.3,13.8,0,19.1l225.1,225c2.6,2.6,6.1,4,9.5,4s6.9-1.3,9.5-4c5.3-5.3,5.3-13.8,0-19.1L145.188,238.575z"/></g></svg>' :
                        '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 477.175 477.175" xml:space="preserve"> <g><path d="M360.731,229.075l-225.1-225.1c-5.3-5.3-13.8-5.3-19.1,0s-5.3,13.8,0,19.1l215.5,215.5l-215.5,215.5c-5.3,5.3-5.3,13.8,0,19.1c2.6,2.6,6.1,4,9.5,4c3.4,0,6.9-1.3,9.5-4l225.1-225.1C365.931,242.875,365.931,234.275,360.731,229.075z"/></g></svg>',
                    prev: document.dir == "rtl" ?
                        '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 477.175 477.175" xml:space="preserve"><g><path d="M360.731,229.075l-225.1-225.1c-5.3-5.3-13.8-5.3-19.1,0s-5.3,13.8,0,19.1l215.5,215.5l-215.5,215.5c-5.3,5.3-5.3,13.8,0,19.1c2.6,2.6,6.1,4,9.5,4c3.4,0,6.9-1.3,9.5-4l225.1-225.1C365.931,242.875,365.931,234.275,360.731,229.075z"/></g></svg>' :
                        '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 477.175 477.175" xml:space="preserve"><g><path d="M145.188,238.575l215.5-215.5c5.3-5.3,5.3-13.8,0-19.1s-13.8-5.3-19.1,0l-225.1,225.1c-5.3,5.3-5.3,13.8,0,19.1l225.1,225c2.6,2.6,6.1,4,9.5,4s6.9-1.3,9.5-4c5.3-5.3,5.3-13.8,0-19.1L145.188,238.575z"/></g></svg>'
                }
            });
        });
    </script>
@endsection

@section('appmodal')
    <!-- Basic modal -->
    <div id="mymodal" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-indigo text-white">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
    <!-- /basic modal -->
@endsection

@section('notification')
    @include('layouts.notification')
@endsection
