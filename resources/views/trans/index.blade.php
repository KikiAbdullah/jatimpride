@extends('layouts.header')

@section('customcss')
@endsection

@section('content')
    <!-- Page header -->
    <div class="page-header">
        <div class="page-header-content d-lg-flex">
            <div class="d-flex">
                <h4 class="page-title mb-0">
                    {{ $subtitle }}
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
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-xxs table-striped" id="dtable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Customer Name</th>
                                    <th>Jenis Pengiriman</th>
                                    <th>Keterangan</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /card -->
            </div>
        </div>
    </div>
    <!-- /content area -->
@endsection

@section('customjs')
    <script type="text/javascript">
        var dtable;
        const urlAjax = '{{ route('trans.get-data') }}';
        const getButtonOption = '{{ route('trans.button-option') }}';
        const buttons = {!! json_encode(['vedit' => $url['edit'], 'destroy' => $url['destroy']]) !!};
        var html_temp = $("#dynamic-form").html();
        var button_temp =
            '<a href="#!" class="btn flex-column btn-float py-2 mx-2 text-uppercase text-dark fw-semibold btnBack"><i class="ph-caret-left ph-2x text-indigo"></i>CANCEL</a>';

        $(document).ready(function($) {
            
            dtable = $('#dtable').DataTable({
                "select": {
                    style: "single",
                    info: false
                },
                "serverSide": true,
                "stateSave": true,
                "sServerMethod": "GET",
                "deferRender": true,
                "rowId": 'id',
                "ajax": urlAjax,
                "columns": [{
                        data: 'id'
                    },
                    {
                        data: 'no'
                    },
                    {
                        data: 'tanggal_formatted'
                    },
                    {
                        data: 'customer_name'
                    },
                    {
                        data: 'jenis_pengiriman_name'
                    },
                    {
                        data: 'text'
                    },
                    {
                        data: 'total'
                    },
                    {
                        data: 'status_formatted'
                    },
                ],
                "order": [
                    [0, "desc"]
                ]
            });
            //set class for page length
            $("#dtable_length").addClass('d-none d-lg-block');

            dtable.on('select', function(e, dt, type, indexes) {
                var rowArrayDtable = dtable.rows('.selected').data().toArray();
                var rowData = dtable.rows(indexes).data().toArray();
                var id = rowData[0].id;
                $.ajax({
                    type: 'GET',
                    url: getButtonOption,
                    data: {
                        id: id,
                        buttons: buttons,
                    },
                    success: function(response) {
                        if (response.status) {
                            backtoCreate();
                            $(".menuoption").html(response.view);

                        }
                    }
                });
            });
            dtable.on('deselect', function(e, dt, type, indexes) {
                if (type === 'row') {
                    backtoCreate();
                }
            });

            //submit form create
            $("body").on("submit", "#dform", function(e) {
                $(this).find('.submit_loader').removeAttr('class').addClass(
                    'ph-spinner spinner submit_loader');
            });

            $("body").on("click", ".editBtn", function(e) {
                $.ajax({
                    url: $(this).attr('href'),
                    type: 'GET',
                    dataType: 'JSON',
                    data: {},
                    success: function(response) {
                        if (response.status) {
                            $("#dynamic-form").html(response.view);
                            $('.select').select2();
                            $('.menuoption').html('');
                            $('.menuoption').prepend(button_temp);
                            button_temp = $('.editBtn').clone();
                            $('.menuoption').find('.editBtn').remove();
                        }
                    }
                });
                e.preventDefault();
            });
            $('body').on('click', '.btnBack', function(e) {
                backtoCreate();
                e.preventDefault();
            });

            $('body').on('click', '.deleteBtn', function(e) {
                var form = $(this).parents('form.delete');
                Swal.fire({
                    icon: 'warning',
                    title: 'Are you sure disable this {{ $title }}?',
                    showCancelButton: true,
                    confirmButtonText: 'Confirm',
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-primary',
                        cancelButton: 'btn btn-light',
                        denyButton: 'btn btn-light',
                        input: 'form-control'
                    },
                    reverseButtons: true,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        Swal.fire({
                            text: 'Loading..',
                            showConfirmButton: false,
                            allowOutsideClick: false
                        });
                        form.submit();
                    }
                })
                e.preventDefault();
            });

            //remove this if you want to update with form submit
            $('body').on('submit', '#formupdate', function(e) {
                swalInit.fire({
                    icon: 'question',
                    title: 'Confirm Save Changes ?',
                    showCancelButton: true,
                    confirmButtonText: 'Confirm',
                    reverseButtons: true,
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        return $.ajax({
                            type: 'PUT',
                            url: $("#formupdate").attr('action'),
                            data: $("#formupdate").serialize(),
                            dataType: "json",
                        }).done(function(data) {
                            return data;
                        }).fail(function(jqXHR, textStatus, errorThrown) {
                            if (jqXHR.status == 422) {
                                var xhr = JSON.stringify(JSON.parse(jqXHR.responseText)
                                    .errors);
                            } else {
                                var xhr = JSON.stringify(JSON.parse(jqXHR
                                    .responseText));
                            }
                            swalInit.fire({
                                title: 'Request Error',
                                text: xhr.substring(0, 160),
                                icon: 'error',
                            })
                        })
                    },
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.value != null)
                        if (result.value.status) {
                            swalInit.fire({
                                title: 'Success',
                                text: result.value.msg,
                                icon: 'success',
                                didClose: () => {
                                    dtable.ajax.reload(null, false);
                                }
                            })
                        } else {
                            swalInit.fire({
                                title: 'Error',
                                text: result.value.msg.substring(0, 160),
                                icon: 'error',
                            })
                        }
                })
                e.preventDefault();
            });

            $('body').on("click", '.btnOption', function(e) {
                e.preventDefault();
                var title = $(this).data('title');
                var url = $(this).attr('href');
                var icon = $(this).data('icon');
                var tipe = $(this).data('tipe');
                var msg = $(this).data('msg');


                var html = '';
                if (tipe == 'closed') {
                    html += '{!! Form::text('noresi', null, [
                        'class' => 'form-control mb-2 field-noresi',
                        'placeholder' => 'Masukan Nomor Resi',
                        'autofocus' => true,
                    ]) !!}' +
                        '<small><cite>Masukan Nomor Resi Apabila Dikirim melalui kurir</cite></small>';
                }

                swalInit.fire({
                    icon: icon,
                    title: title,
                    html: tipe == 'closed' ? html : 'Are you sure ' + title + ' ?',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    confirmButtonColor: 'red',
                    reverseButtons: true,
                    showLoaderOnConfirm: true,
                    didOpen: () => {
                        // The textfield element
                        textField = Swal.getPopup().querySelector(".field-noresi")
                        textField?.focus()
                    },
                    preConfirm: (value) => {
                        let noresi = Swal.getPopup().querySelector(".field-noresi")?.value || 1;

                        if (tipe == 'closed') {
                            return $.ajax({
                                type: 'POST',
                                url: url,
                                data: {
                                    noresi: noresi,
                                },
                                dataType: "json",
                            }).done(function(data) {
                                return data;
                            }).fail(function(jqXHR, textStatus, errorThrown) {
                                if (jqXHR.status == 422) {
                                    var xhr = JSON.stringify(JSON.parse(jqXHR
                                            .responseText)
                                        .errors);
                                } else {
                                    var xhr = JSON.stringify(JSON.parse(jqXHR
                                        .responseText));
                                }
                                swalInit.fire({
                                    title: 'Request Error',
                                    text: xhr.substring(0, 160),
                                    icon: 'error',
                                })
                            })
                        } else {
                            return $.ajax({
                                type: 'POST',
                                url: url,
                                dataType: "json",
                            }).done(function(data) {
                                return data;
                            }).fail(function(jqXHR, textStatus, errorThrown) {
                                if (jqXHR.status == 422) {
                                    var xhr = JSON.stringify(JSON.parse(jqXHR
                                            .responseText)
                                        .errors);
                                } else {
                                    var xhr = JSON.stringify(JSON.parse(jqXHR
                                        .responseText));
                                }
                                swalInit.fire({
                                    title: 'Request Error',
                                    text: xhr.substring(0, 160),
                                    icon: 'error',
                                })
                            })
                        }


                    },
                    allowEscapeKey: false,
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.value != null)
                        if (result.value.status) {
                            swalInit.fire({
                                title: 'Success',
                                text: result.value.msg,
                                icon: 'success',
                            })
                            dtable.ajax.reload(null, false)
                            $('#mymodal').modal('hide');

                        } else {
                            swalInit.fire({
                                title: 'Error',
                                text: result.value.msg.substring(0, 160),
                                icon: 'error',
                            })
                        }
                })
            });
        });

        function confirmTrans(el, e) {
            $("#mymodal").find('.modal-body').html(
                '<center><i class="ph-spinner spinner"></i></center>');
            $("#mymodal").find('.modal-title').html('Konfirmasi');
            $("#mymodal").find('.modal-dialog').removeAttr('class').attr('class',
                'modal-dialog modal-xl');
            $("#mymodal").modal({
                backdrop: 'static',
            }).modal('show');
            $.ajax({
                url: $(el).attr('href'),
                type: 'GET',
                dataType: 'JSON',
                data: {},
                success: function(response) {
                    if (response.status) {
                        $("#mymodal").find('.modal-body').html(response.view);
                        $("#mymodal").find('select.select').select2({
                            dropdownParent: $('#mymodal')
                        });

                    }
                }
            });


            e.preventDefault();

        }

        function backtoCreate() {
            $("#dynamic-form").html(html_temp);
            $('.menuoption').html('');
            $('.menuoption').prepend(button_temp);
            button_temp = $('.btnBack').clone();
            $('.menuoption').find('.btnBack').remove();
            $('.select').select2();
        }
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
