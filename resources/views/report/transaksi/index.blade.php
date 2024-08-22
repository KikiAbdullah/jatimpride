@extends('layouts.header')

@section('content')
    <div class="page-header">
        <div class="page-header-content container header-elements-md-inline">
        </div>
    </div>
    <div class="content pt-4">
        <div class="d-flex">
            <div class="card w-100 w-md-50 mx-auto">
                <div class="card-header bg-indigo text-white">
                    <h5 class="card-title fw-semibold">{{ $title }}</h5>
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => 'report.transaksi.result', 'method' => 'POST']) !!}
                    <div class="row mb-3">
                        <label class="col-lg-3 col-form-label text-lg-end d-none d-lg-block">Tanggal</label>
                        <div class="col-lg-9">
                            {!! Form::text('tanggal', null, ['class' => 'form-control daterange']) !!}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-3 col-form-label text-lg-end d-none d-lg-block">Jenis Pengiriman</label>
                        <div class="col-lg-9">
                            {!! Form::select('jenis_pengiriman_id', $data['list_jenis_pengiriman'], null, [
                                'class' => 'select',
                                'placeholder' => 'Semua Jenis Pengiriman',
                            ]) !!}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-3 col-form-label text-lg-end d-none d-lg-block">Status</label>
                        <div class="col-lg-9">
                            {!! Form::select('status[]', $data['list_status'], null, [
                                'class' => 'select',
                                'data-placeholder' => 'Semua Status',
                                'multiple',
                            ]) !!}
                        </div>
                    </div>
                    <div class="d-flex justify-content-end align-items-center">
                        <button type="submit" class="btn btn-secondary btn-labeled btn-labeled-start rounded-pill"
                            onclick="ResultReport(this, event)">
                            <span class="btn-labeled-icon bg-black bg-opacity-20 m-1 rounded-pill">
                                <i class="ph-magnifying-glass" id="submit_loader"></i>
                            </span>
                            Submit
                        </button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="d-flex" id="content">
        </div>
    </div>
@endsection

@section('customjs')
    <script src="{{ asset('app_local/js/swal.js') }}"></script>
    <script type="text/javascript">
        const ResultReport = (el, e) => {
            e.preventDefault();

            var form = $(el).closest('form');
            form.find('button').attr('disabled', 'disabled');
            form.find('#submit_loader').removeAttr('class').addClass('ph-spinner spinner');

            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                dataType: 'JSON',
                data: form.serialize(),
            }).done(function(response) {
                if (response.status) {
                    $("#content").html(response.data);
                } else {
                    swalInit.fire({
                        title: 'Uuupss',
                        text: response.msg,
                        icon: 'error',
                    })
                }
            }).fail(function(jqXHR, textStatus, errorThrown) {
                if (jqXHR.status == 422) {
                    var xhr = JSON.stringify(JSON.parse(jqXHR.responseText).errors);
                } else {
                    var xhr = JSON.stringify(JSON.parse(jqXHR.responseText));
                }
                swalInit.fire({
                    title: 'Request Error',
                    text: xhr.substring(0, 160),
                    icon: 'error',
                })
            }).always(function() {
                form.find('button').removeAttr('disabled');
                form.find('#submit_loader').removeAttr('class').addClass('ph-magnifying-glass');
            })
        }

        const ExportExcel = (title) => {
            var tT = new XMLSerializer().serializeToString(document.querySelector('.content_isi'));
            var tF = `JATIMPRIDE - ${title}.xls`;
            var tB = new Blob([tT]);

            if (window.navigator.msSaveOrOpenBlob) {
                window.navigator.msSaveOrOpenBlob(tB, tF)
            } else {
                var tA = document.body.appendChild(document.createElement('a'));
                tA.href = URL.createObjectURL(tB);
                tA.download = tF;
                tA.style.display = 'none';
                tA.click();
                tA.parentNode.removeChild(tA)
            }
        }
    </script>
@endsection
