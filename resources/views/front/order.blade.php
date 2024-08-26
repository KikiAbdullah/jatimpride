@extends('front.layout')

@section('content')
    <!-- Team Section -->
    <section id="contact" class="contact section mt-5">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>ORDER</h2>
            <p>MERCHANDISE ORDER</p>
        </div><!-- End Section Title -->

        <div class="container form-login">
            <div class="row">
                <div class="col-md-4 col-sm-12 mt-3">
                    <h3 class="h3">Merchandise Size</h3>
                    <div class="bd-example-snippet bd-code-snippet mb-5">
                        <div class="bd-example m-0 border-0">
                            <div class="row overflow-auto px-2" id="tickets">
                                @foreach ($data['merch'] as $merch)
                                    <div class="callout callout-primary p-3 my-2 ">
                                        <div class="row">
                                            <div class="col-6">
                                                <p class="tix-cat">{{ $merch->name_size }}</p>
                                                <strong>{{ $merch->harga_formatted }}</strong>
                                            </div>
                                            <div class="col-6">
                                                <div class="input-group" id="tCategory">
                                                    <button type="button"
                                                        class="btn btn-outline-secondary btn-number mx-0 p-1"
                                                        data-type="minus" data-field="qty[{{ $merch->id }}]"
                                                        disabled="disabled"><i class="bi-trash"></i></button>
                                                    <input type="text" name="qty[{{ $merch->id }}]"
                                                        id="merch_{{ $merch->id }}" data-name="{{ $merch->name_size }}"
                                                        data-category="1" data-detail-id="{{ $merch->id }}"
                                                        data-rate="{{ $merch->harga }}" data-price="{{ $merch->harga }}"
                                                        class="form-control input-number" value="0" min="0"
                                                        max="{{ $merch->stok }}">
                                                    <button type="button"
                                                        class="btn btn-outline-secondary btn-number mx-0 p-1"
                                                        data-type="plus" data-field="qty[{{ $merch->id }}]"><i
                                                            class="bi-plus-lg"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-sm-12 mt-3">
                    <h3 class="h3">Customer Details</h3>
                    <div class="bd-example-snippet bd-code-snippet mb-5">
                        <div class="bd-example m-0 border-0">
                            <div class="row">
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <label for="regFullNameHelp" class="form-label">Nama Lengkap</label>
                                    <div class="input-group has-validation">
                                        <input type="text" class="form-control" id="regFullName"
                                            value="{{ auth()->user()->name ?? '' }}" disabled="">
                                        <input type="hidden" id="regId" value="{{ auth()->user()->id }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <label for="regPhoneHelp" class="form-label">Whatsapp</label>
                                    <input type="text" class="form-control" id="regPhone"
                                        value="{{ auth()->user()->nowa ?? '' }}" disabled="">
                                </div>
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <label for="regEmailHelp" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="regEmail"
                                        aria-describedby="regEmailHelp" value="{{ auth()->user()->email ?? '' }}"
                                        disabled="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <h3 class="h3">Items Details</h3>
                    <div class="bd-example-snippet bd-code-snippet mb-5">
                        <div class="bd-example m-0 border-0" id="item-details"></div>
                    </div>
                    <div class="bd-example-snippet bd-code-snippet mb-5">
                        <div class="bd-example m-0 border-0">
                            <div class="row">
                                <div class="col-6">
                                    <h3 class="float-start">Total</h3>
                                </div>
                                <div class="col-6">
                                    <h3 class="float-end" id="merch-total" data-amount="0">Rp0</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary w-100" id="pay-button">Lanjutkan
                        Pemesanan</button>
                </div>
            </div>

        </div>

    </section><!-- /Team Section -->
@endsection

@section('customjs')
    <script>
        var payButton = document.getElementById('pay-button');
        var ticketAmount = 0;
        var addonAmount = 0;
        var merchAmount = 0;
        const getKota = '{{ route('get.kota') }}';
        const getKecamatan = '{{ route('get.kecamatan') }}';
        const getKelurahan = '{{ route('get.kelurahan') }}';


        $(document).ready(function() {
            itemDetails();


            $(document).delegate(".btn-number", "click", function(e) {
                e.preventDefault();
                fieldName = $(this).attr('data-field');
                type = $(this).attr('data-type');
                var input = $("input[name='" + fieldName + "']");
                var currentVal = parseInt(input.val());
                var merchId = input.attr('id').split("_").pop();

                if (!isNaN(currentVal)) {
                    if (type == 'minus') {
                        if (currentVal > input.attr('min')) {
                            input.val(currentVal - 1).change();
                        }
                        if (parseInt(input.val()) == input.attr('min')) {

                            $(this).attr('disabled', true);
                            //console.log('delete ' + merchId + ' now');
                            merchString = JSON.stringify(RemoveItem(merchId));
                            if (window.localStorage) {
                                window.localStorage.setItem("merchandise", merchString);
                            }
                            input.val(0).change();
                        }
                    } else if (type == 'plus') {
                        if (currentVal < input.attr('max')) {
                            input.val(currentVal + 1).change();
                        }
                        if (parseInt(input.val()) == input.attr('max')) {
                            $(this).attr('disabled', true);
                        }
                    }
                } else {
                    input.val(0);
                }
            });
            $('.input-number').focusin(function() {
                $(this).data('oldValue', $(this).val());
            });
            $(document).delegate(".input-number", "change", function(event) {
                minValue = parseInt($(this).attr('min'));
                maxValue = parseInt($(this).attr('max'));
                valueCurrent = parseInt($(this).val());

                name = $(this).attr('name');
                if (valueCurrent >= minValue) {
                    $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled');
                    $(".btn-number[data-type='minus'][data-field='" + name + "']").find(".bi-plus-lg")
                        .removeClass("bi-plus-lg").addClass("bi-dash-lg");
                } else {
                    alert('Sorry, the minimum value was reached');
                    $(this).val($(this).data('oldValue'));
                }
                if (valueCurrent <= maxValue) {
                    $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled');
                    $(".btn-number[data-type='minus'][data-field='" + name + "']").find(".bi-plus-lg")
                        .removeClass("bi-plus-lg").addClass("bi-dash-lg");
                } else {
                    alert('Sorry, the maximum value was reached');
                    $(this).val($(this).data('oldValue'));
                }
                if (valueCurrent <= 1) {
                    $(".btn-number[data-type='minus'][data-field='" + name + "']").find(".bi-dash-lg")
                        .removeClass("bi-dash-lg").addClass("bi-trash");
                }
                itemDetails();
            });
            $(document).delegate(".input-number", "keydown", function(e) {
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                    // Allow: Ctrl+A
                    (e.keyCode == 65 && e.ctrlKey === true) ||
                    // Allow: home, end, left, right
                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                    // let it happen, don't do anything
                    return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode >
                        105)) {
                    e.preventDefault();
                }
            });

            var merch = JSON.parse(window.localStorage.getItem('merchandise'));

            if (!merch) {
                merch = [];
            }


            if (merch.length > 0) {
                var merchItems = '';
                var stock = 0;
                merch.forEach((element, i) => {
                    stock = (element.stock > 5) ? 5 : element.stock;
                    merchItems +=
                        `<div class="col-12 col-lg-6 mb-4" id="merch_` + element.id + `"><div class="card float-right pb-0"><div class="row">
                        <div class="col-5 col-lg-4 order-status"><img class="d-block w-100" src="` + element.photo + `" alt=""></div>
                        <div class="col-7 col-lg-8"><div class="card-block-ticket h-100 order-cta px-0">
                            <strong>` + element.name + `</strong>
                            <span class="w-100">
                            <i class="bi-aspect-ratio w-100"></i> ` + element.size +
                        ` | <i class="bi-palette w-100"></i> ` + element
                        .color + `
                            </span>
                            <span class="w-100">
                            <i class="bi-tag w-100"></i> Rp` + element.price.toString().replace(
                            /(\d)(?=(\d{3})+(?!\d))/g, "$1.") +
                        `
                            </span>
                            <div class="row my-2 justify-content-start"><div class="col-8 col-lg-5"><div class="input-group">
                            <button type="button" class="btn btn-outline-secondary btn-number mx-0 p-1" data-type="minus" data-field="qty[` +
                        element.id + `]"><i class="bi-dash-lg"></i></button>
                            <input type="text" name="qty[` + element.id + `]" id="product_` + element.id +
                        `" data-name="` + element
                        .name + `" data-category="` + element.category + `" data-detail-id="` + element
                        .detail_id + `" data-rate="` + element.rate + `" data-price="` + element.price +
                        `" class="form-control input-number" value="` + parseInt(element.qty) +
                        `" min="0" max="` + element.maximum +
                        `">
                            <button type="button" class="btn btn-outline-secondary btn-number mx-0 p-1" data-type="plus" data-field="qty[` +
                        element.id + `]"><i class="bi-plus-lg"></i></button>
                            </div></div></div>
                        </div></div>
                        </div></div></div>`
                });
                $('.merchandise').html(merchItems);
                var totalProduct = merch.reduce((a, b) => a + (b.category.toString().startsWith('product') ? b
                    .gross : 0), 0);
                $('#merch-total').data('amount', totalProduct);
                itemDetails();
            }

            $(document).on("click", "#pay-button", function(e) {
                var merch = getAllTickets();
                if (merch.length > 0) {
                    $.ajax({
                            type: 'POST',
                            url: '{{ route('front.order-store') }}',
                            data: {
                                merch: merch
                            },
                            dataType: "json",
                            success: (response) => {
                                if (response.status == true) {
                                    Swal.fire({
                                        toast: true,
                                        title: 'Berhasil',
                                        text: response.msg,
                                        icon: 'success',
                                        showConfirmButton: false,
                                        timer: 3000,
                                        timerProgressBar: true,
                                        willClose: () => {
                                            window.location.href =
                                                '{{ route('front.payment') }}';
                                        }
                                    })
                                } else {
                                    Swal.fire({
                                        toast: true,
                                        title: 'Gagal',
                                        text: response.msg,
                                        icon: 'error',
                                        showConfirmButton: false,
                                        timer: 3000,
                                        timerProgressBar: true,
                                    });
                                }
                            },
                        })
                        .done(function(data) {
                            return data;
                        })
                        .fail(function(jqXHR, textStatus, errorThrown) {

                            if (jqXHR.status == 422) {
                                var xhr = JSON.stringify(JSON.parse(jqXHR.responseText).errors);
                            } else {
                                var xhr = JSON.stringify(JSON.parse(jqXHR.responseText));

                            }

                            Swal.fire({
                                toast: true,
                                title: 'Request Error',
                                text: xhr.substring(0, 160),
                                icon: 'error',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            })

                            $("#l-modal-form").find('button[type="submit"]').prop('disabled', false);
                        });

                } else {
                    Swal.fire({
                        toast: true,
                        title: 'Gagal',
                        text: 'Belum ada produk yang terpilih',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                    });
                }

            });

            // Run toggleAddressRow when the page is loaded
            toggleAddressRow();

            // Bind the change event to the radio buttons
            $('input[name="jenis_pengiriman_id"]').change(function() {
                toggleAddressRow();
            });
        });

        function RemoveItem(id) {
            var merch = JSON.parse(window.localStorage.getItem("merchandise"));

            return merch.filter(function(emp) {
                if (emp.id == id) {
                    return false;
                }
                return true;
            });
        }

        function getAllTickets() {
            var ticketCategories = $('.input-number').map(function() {
                if (parseInt($(this).val()) > 0) {
                    var idProduct = $(this).attr('id').split('_')[1];
                    var idDetail = $(this).data('detail-id');
                    return {
                        'id': parseInt(idProduct),
                        'id_detail': parseInt(idDetail),
                        'category': $(this).attr('id'),
                        'category_id': $(this).data('category'),
                        'name': $(this).data('name'),
                        'qty': parseInt($(this).val()),
                        'price': parseInt($(this).data('price')),
                        'rate': parseInt($(this).data('rate')),
                        'gross': parseInt($(this).val()) * parseInt($(this).data('price'))
                    };
                }
            }).get();
            return ticketCategories;
        }

        function itemDetails() {
            var attrItems = '';
            var allItems = getAllTickets();
            var totalName = allItems.reduce((a, b) => (b.category.startsWith('merch') ? b.name : 0), 0);
            var merchTotal = allItems.reduce((a, b) => a + (b.category.startsWith('merch') ? b.gross : 0), 0);

            $('#merch-total').data('amount', merchTotal);

            $('#item-details').empty();
            getAllTickets().forEach((element, i) => {
                attrItems +=
                    `<div class="row">
                    <div class="col-6">
                        <div class="ticket-category text-grey">` + element.name + `</div>
                        <div class="ticket-category-qty">Rp` + element.price.toString().replace(
                        /(\d)(?=(\d{3})+(?!\d))/g, "$1.") +
                    ` x ` + element.qty + `</div>
                    </div>
                    <div class="col-6">
                        <h6 class="float-end">Rp` + element.gross.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g,
                        "$1.") + `</h6>
                    </div>
                    </div>`;
                if (i !== allItems.length - 1)
                    attrItems += `<hr class="hr mt-4 mb-4" />`;
            });

            $('#item-details').html(attrItems);
            $('#merch-total').html('Rp' + merchTotal.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."));
        }

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

        // Function to toggle visibility of #alamat-row based on selected jenis_pengiriman_id
        function toggleAddressRow() {
            // Get the selected value of the radio buttons
            var selectedJenisPengiriman = $('input[name="jenis_pengiriman_id"]:checked').val();

            // Show or hide #alamat-row based on the selected value
            if (selectedJenisPengiriman == 1) {
                $('#alamat-row').show();
                $('#dikirim-row').hide();
            } else {
                $('.provinsi_pribadi').val('').trigger('change');
                $('.kota').val('').trigger('change');
                $('.kecamatan').val('').trigger('change');
                $('.kelurahan').val('').trigger('change');
                $('#dikirim-row').show();
                $('#alamat-row').hide();
            }
        }
    </script>
@endsection
