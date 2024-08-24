@extends('front.layout')

@section('content')
    <!-- Team Section -->
    <section id="contact" class="contact section mt-5">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>{{ $item->no }}</h2>
            <p>HISTORY TRANSACTION</p>
        </div>
        <!-- End Section Title -->

        <div class="container form-login">
            <div class="row">
                <div class="col-md-6 col-sm-12 mt-3">
                    <h3 class="h3">Transaksi</h3>
                    <div class="bd-example-snippet bd-code-snippet mb-5">
                        <ul>
                            <li><strong>Tanggal</strong>:
                                {{ $item->created_at->format('d F Y H:i:s') ?? '' }}
                            </li>
                            <li><strong>Customer</strong>: {{ $item->customer->name ?? '' }}
                            </li>
                            <li>
                                <strong>Jenis Pengiriman</strong>:
                                {{ $item->jenisPengiriman->name ?? '' }}
                            </li>
                            <li><strong>Total</strong>: Rp {{ cleanNumber($item->total) }}
                            </li>
                            <li><strong>Catatan</strong>:<br> {{ $item->text }}
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 mt-3">
                    <h3 class="h3">Transaksi</h3>
                    <div class="bd-example-snippet bd-code-snippet mb-5">
                        <div class="bd-example m-0 border-0">
                            <div class="row overflow-auto px-2" id="tickets">
                                @foreach ($item->lines as $line)
                                    <div class="callout callout-primary p-3 my-2 ">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="ticket-category text-grey">{{ $line->merch->name_size }}</div>
                                                <div class="ticket-category-qty">{{ $line->harga_formatted }} x
                                                    {{ $line->qty }}</div>
                                            </div>
                                            <div class="col-6">
                                                <h6 class="float-end">{{ $line->total_formatted }}</h6>
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
                                            <h6 class="float-end">Rp {{ cleanNumber($item->lines->sum('total')) }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
            // Get the selected value of the radio buttons
            var selectedJenisPengiriman = $('input[name="jenis_pengiriman_id"]:checked').val();

            $('#jenis-pengiriman-id').val(selectedJenisPengiriman);

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
