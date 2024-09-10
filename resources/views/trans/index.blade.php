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
                    {{-- <a href="{{ route('trans.form-create') }}"
                        class="btn flex-column btn-float py-2 mx-2 text-uppercase text-dark fw-semibold addBtn"><i
                            class="ph-plus-circle ph-2x text-indigo"></i>Transaksi Baru
                    </a> --}}

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
                        <table class="table table-xxs" id="dtable">
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
    <script src="{{ asset('assets/js/vendor/media/glightbox.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        var dtable;
        const urlAjax = '{{ route('trans.get-data') }}';
        const getButtonOption = '{{ route('trans.button-option') }}';
        const buttons = {!! json_encode(['destroy' => $url['destroy']]) !!};
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

            $("body").on("click", ".addBtn", function(e) {
                $("#mymodal").find('.modal-body').html(
                    '<center><i class="ph-spinner spinner"></i></center>');
                $("#mymodal").find('.modal-title').html('Transaksi Baru');
                $("#mymodal").find('.modal-dialog').removeAttr('class').attr('class',
                    'modal-dialog modal-xl');
                $("#mymodal").modal({
                    backdrop: 'static',
                }).modal('show');
                $.ajax({
                    url: $(this).attr('href'),
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
                            dtable.ajax.reload(null, false);
                            $('#mymodal').modal('hide');
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

        function toggleAddressRow(el) {
            // Get the selected value of the radio buttons
            var selectedJenisPengiriman = $(el).val();

            // Show or hide #alamat-row based on the selected value
            if (selectedJenisPengiriman == 1) {
                $('.dikirim-row').show();
            } else {
                $('.dikirim-row').hide();
            }
        }


        const getKota = '{{ route('get.kota') }}';
        const getKecamatan = '{{ route('get.kecamatan') }}';
        const getKelurahan = '{{ route('get.kelurahan') }}';

        function stateChange(url_type = null, el = null, to_element = null, to_element_hidden = null) {
            if (url_type !== null) {
                $.ajax({
                    type: "GET",
                    url: "" + getUrl(url_type),
                    data: {
                        id: $(el).val(),
                        _token: _csrf_token
                    },
                    dataType: "json",
                    success: function(response) {
                        $('.' + to_element).find('option').remove().end();
                        $('.' + to_element).append($("<option></option>")
                            .attr('value', '')
                            .text('Pilih')
                            .attr('selected', 'selected'));
                        $.each(response, function(key, value) {
                            $("." + to_element)
                                .append($("<option></option>")
                                    .attr("value", key)
                                    .text(value));
                        });
                    },
                    fail: function(errMsg) {
                        // alert(errMsg);
                    }
                });
            }
        }

        function getUrl(url_type) {
            var new_url = '';

            if (url_type == '/get-kota') {
                new_url = getKota;
            }

            if (url_type == '/get-kecamatan') {
                new_url = getKecamatan;
            }

            if (url_type == '/get-kelurahan') {
                new_url = getKelurahan;
            }

            return new_url;
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
