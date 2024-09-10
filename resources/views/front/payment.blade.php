@extends('front.layout')

@section('content')
    <!-- Team Section -->
    <section id="contact" class="contact section mt-5">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>PAYMENT</h2>
            <p>MERCHANDISE PAYMENT</p>
        </div>
        <!-- End Section Title -->

        <div class="container form-login">
            <div class="page-title">
                <nav class="breadcrumbs">
                    <div class="container">
                        <ol>
                            <li><a href="{{ route('front.merchandise') }}">Merchandise</a></li>
                            <li><a href="{{ route('front.order') }}">Order</a></li>
                            <li class="current">Payment</li>
                        </ol>
                    </div>
                </nav>
            </div>


            <div class="row my-3">
                <div class="col-md-4 col-sm-12">
                    <h3 class="h3">Merchandise</h3>
                    <div class="bd-example-snippet bd-code-snippet mb-5">
                        <div class="bd-example m-0 border-0">
                            <div class="row overflow-auto px-2" id="tickets">
                                @foreach ($data['cart'] as $item)
                                    <div class="callout callout-primary p-3 my-2 ">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="ticket-category text-grey">{{ $item->merch->name_size }}</div>
                                                <div class="ticket-category-qty">{{ $item->merch->harga_formatted }} x
                                                    {{ $item->qty }}</div>
                                            </div>
                                            <div class="col-6">
                                                <h6 class="float-end">{{ $item->total_formatted }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                @endforeach
                                <div class="callout callout-primary p-3 my-2 ">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="ticket-category text-grey">Total</div>
                                        </div>
                                        <div class="col-6">
                                            <h6 class="float-end">Rp {{ cleanNumber($data['cart']->sum('total')) }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-sm-12">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                {!! $error . '<br/>' !!}
                            @endforeach
                        </div>
                    @endif

                    {!! Form::open(['route' => 'front.payment-store', 'method' => 'POST', 'id' => 'dform', 'files' => true]) !!}

                    <h3 class="h3">Jenis Pengiriman</h3>
                    <div class="bd-example-snippet bd-code-snippet mb-5">
                        <div class="bd-example mb-5 border-0">
                            @foreach ($data['list_jenis_pengiriman'] as $jenisPengiriman)
                                <input type="radio" class="btn-check" name="jenis_pengiriman_id"
                                    value="{{ $jenisPengiriman->id }}" id="jenis-{{ $jenisPengiriman->id }}"
                                    data-text="{{ $jenisPengiriman->text }}" autocomplete="off">
                                <label class="btn btn-outline-warning" style="min-width: 30%"
                                    for="jenis-{{ $jenisPengiriman->id }}">{{ $jenisPengiriman->name }}</label>
                            @endforeach
                            {!! Form::hidden('jenis_pengiriman_id', null, ['id' => 'jenis-pengiriman-id']) !!}
                        </div>

                        <div class="alert alert-warning mb-3" id="text-pengiriman" style="display: none;" role="alert">
                        </div>

                        <div class="bd-example row" id="alamat-row">

                            <div class="col-md-6 col-sm-12 mb-3">
                                <label for="regFullNameHelp" class="form-label">Provinsi</label>
                                <div class="input-group has-validation">
                                    {!! Form::select('provinsi_id', $data['list_provinsi'], null, [
                                        'class' => 'form-control mb-3 select provinsi_pribadi',
                                        'placeholder' => 'Provinsi',
                                        'onchange' => 'stateChange("/get-kota", this, "kota","nama_provinsi_pribadi")',
                                    ]) !!}
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12 mb-3">
                                <label for="regFullNameHelp" class="form-label">Kabupaten</label>
                                <div class="input-group has-validation">
                                    {!! Form::select('kabupaten_id', isset($custom_data) ? $custom_data['list_kabupaten'] : [], null, [
                                        'class' => 'form-control mb-3 select kota',
                                        'placeholder' => 'Kabupaten',
                                        'onchange' => 'stateChange("/get-kecamatan", this, "kecamatan", "nama_kota_pribadi")',
                                    ]) !!}
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12 mb-3">
                                <label for="regFullNameHelp" class="form-label">Kecamatan</label>
                                <div class="input-group has-validation">
                                    {!! Form::select('kecamatan_id', isset($custom_data) ? $custom_data['list_kecamatan'] : [], null, [
                                        'class' => 'form-control mb-3 select kecamatan',
                                        'placeholder' => 'Kecamatan',
                                        'onchange' => 'stateChange("/get-kelurahan", this, "kelurahan", "nama_kecamatan_pribadi")',
                                    ]) !!}
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12 mb-3">
                                <label for="regFullNameHelp" class="form-label">Kelurahan</label>
                                <div class="input-group has-validation">
                                    {!! Form::select('kelurahan_id', isset($custom_data) ? $custom_data['list_kelurahan'] : [], null, [
                                        'class' => 'form-control mb-3 select kelurahan',
                                        'placeholder' => 'Kelurahan',
                                        'onchange' => 'stateChange(null, this, null, "nama_kelurahan_pribadi")',
                                    ]) !!}
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12 mb-3">
                                <label for="regFullNameHelp" class="form-label">Alamat</label>
                                <div class="input-group has-validation">
                                    {!! Form::textarea('alamat', null, ['class' => 'form-control', 'placeholder' => 'Alamat', 'rows' => 2]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="bd-example row">
                            <div class="col-md-12">
                                <p>Transfer Pembayaran kamu ke rekening BCA</p>
                            </div>
                            <div class="d-flex mb-5">
                                <img src="{{ asset('app_local/img/bca.svg') }}" class="img-fluid" style="max-width: 100px;"
                                    alt="">
                                <div class="ms-3">
                                    <h3 class="fw-bold text-warning">RAKA NURDIANSYAH</h3>
                                    <h3 class="fs-lg fw-semibold">1991537649</h3>
                                    <input type="hidden" value="1991537649" id="norek">
                                    <a class="text-warning" onclick="copyRekening()"><i class="bi bi-copy"></i> Copy
                                        Rekening</a>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 mb-3">
                                <label for="regFullNameHelp" class="form-label">Upload Bukti Pembayaran</label>
                                <div class="input-group has-validation">
                                    {!! Form::file('bukti_pengiriman', null, ['class' => 'form-control', 'placeholder' => 'Alamat']) !!}
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 mb-3">
                                <label for="regFullNameHelp" class="form-label">Catatan</label>
                                <div class="input-group has-validation">
                                    {!! Form::textarea('text', null, ['class' => 'form-control', 'placeholder' => 'Catatan', 'rows' => 2]) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100" id="pay-button">
                        Selesaikan Transaksi
                    </button>
                    {!! Form::close() !!}
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
            // Run toggleAddressRow when the page is loaded
            toggleAddressRow();

            // Bind the change event to the radio buttons
            $('input[name="jenis_pengiriman_id"]').change(function() {
                toggleAddressRow();
            });
        });

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

            $('#alamat-row').hide();
            $('#text-pengiriman').hide();


            // Get the selected value of the radio buttons
            var selectedJenisPengiriman = $('input[name="jenis_pengiriman_id"]:checked').val();
            var keterangan = $('input[name="jenis_pengiriman_id"]:checked').data('text');


            $('#jenis-pengiriman-id').val(selectedJenisPengiriman);

            // Show or hide #alamat-row based on the selected value
            if (selectedJenisPengiriman == 1) {

                $('#alamat-row').show();
                $('#text-pengiriman').show();

            } else if (selectedJenisPengiriman == 2) {
                $('.provinsi_pribadi').val('').trigger('change');
                $('.kota').val('').trigger('change');
                $('.kecamatan').val('').trigger('change');
                $('.kelurahan').val('').trigger('change');
                $('#alamat-row').hide();
                $('#text-pengiriman').show();


            }

            $('#text-pengiriman').html(keterangan);
        }

        function copyRekening() {
            // Get the text field
            var copyText = document.getElementById('norek');

            // Copy the text inside the text field
            navigator.clipboard.writeText(copyText.value);

            Swal.fire({
                title: "Copy To Clipboard",
                toast: true,
                position: 'top-right',
                showConfirmButton: false,
                timer: 3000,
            });
        }
    </script>
@endsection
