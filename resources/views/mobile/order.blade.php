@extends('layouts.mobile')

@section('content')
    <div class="container">
        {!! Form::open(['route' => 'mobile.order-store', 'method' => 'POST', 'id' => 'dform', 'files' => true]) !!}
        <!-- Checkout Wrapper-->
        <div class="checkout-wrapper-area py-3">
            <!-- Billing Address-->
            <div class="billing-information-card mb-3">
                <div class="card billing-information-title-card bg-primary">
                    <div class="card-body">
                        <h6 class="text-center mb-0 text-white">Detail Pemesanan</h6>
                    </div>
                </div>
                <div class="card user-data-card">
                    <div class="card-body">
                        <div class="single-profile-data d-flex align-items-center justify-content-between">
                            <div class="title d-flex align-items-center"><i class="lni lni-user"></i><span>Nama
                                    Lengkap</span>
                            </div>
                            <div class="data-content">{{ auth()->user()->name ?? '' }}</div>
                        </div>
                        <div class="single-profile-data d-flex align-items-center justify-content-between">
                            <div class="title d-flex align-items-center"><i class="lni lni-envelope"></i><span>Email</span>
                            </div>
                            <div class="data-content">{{ auth()->user()->email ?? '' }}</div>
                        </div>
                        <div class="single-profile-data d-flex align-items-center justify-content-between">
                            <div class="title d-flex align-items-center"><i class="lni lni-phone"></i><span>Whatsapp</span>
                            </div>
                            <div class="data-content">{{ auth()->user()->nowa ?? '' }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="title mb-2"><i class="lni lni-map-marker"></i><span>Alamat</span></div>
                            {!! Form::select('provinsi_id', $data['list_provinsi'], null, [
                                'class' => 'form-control mb-3 select provinsi_pribadi',
                                'placeholder' => 'Provinsi',
                                'onchange' => 'stateChange("/get-kota", this, "kota","nama_provinsi_pribadi")',
                            ]) !!}
                            {!! Form::select('kabupaten_id', isset($custom_data) ? $custom_data['list_kabupaten'] : [], null, [
                                'class' => 'form-control mb-3 select kota',
                                'placeholder' => 'Kabupaten',
                                'onchange' => 'stateChange("/get-kecamatan", this, "kecamatan", "nama_kota_pribadi")',
                            ]) !!}
                            {!! Form::select('kecamatan_id', isset($custom_data) ? $custom_data['list_kecamatan'] : [], null, [
                                'class' => 'form-control mb-3 select kecamatan',
                                'placeholder' => 'Kecamatan',
                                'onchange' => 'stateChange("/get-kelurahan", this, "kelurahan", "nama_kecamatan_pribadi")',
                            ]) !!}
                            {!! Form::select('kelurahan_id', isset($custom_data) ? $custom_data['list_kelurahan'] : [], null, [
                                'class' => 'form-control mb-3 select kelurahan',
                                'placeholder' => 'Kelurahan',
                                'onchange' => 'stateChange(null, this, null, "nama_kelurahan_pribadi")',
                            ]) !!}
                            {!! Form::textarea('alamat', null, ['class' => 'form-control', 'placeholder' => 'Alamat', 'rows' => 2]) !!}
                        </div>

                        <div class="mb-3">
                            <div class="title mb-2"><i class="lni lni-pencil"></i><span>Keterangan</span></div>

                            {!! Form::textarea('text', null, ['class' => 'form-control', 'placeholder' => 'Keterangan', 'rows' => 2]) !!}

                        </div>
                    </div>
                </div>
            </div>
            <!-- Shipping Method Choose-->
            <div class="shipping-method-choose mb-3">
                <div class="card shipping-method-choose-title-card bg-success">
                    <div class="card-body">
                        <h6 class="text-center mb-0 text-white">Jenis Pengiriman</h6>
                    </div>
                </div>
                <div class="card shipping-method-choose-card">
                    <div class="card-body">
                        <div class="shipping-method-choose">
                            <ul class="ps-0">
                                @foreach ($data['list_jenis_pengiriman'] as $jenisPengiriman)
                                    <li>
                                        <input id="jenis-{{ $jenisPengiriman->id }}" type="radio"
                                            name="jenis_pengiriman_id" value="{{ $jenisPengiriman->id }}">
                                        <label for="jenis-{{ $jenisPengiriman->id }}">{{ $jenisPengiriman->name }}
                                            <br><small>{{ $jenisPengiriman->text }}</small></label>
                                        <div class="check"></div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shipping Method Choose-->
            <div class="shipping-method-choose mb-3">
                <div class="card shipping-method-choose-title-card bg-success">
                    <div class="card-body">
                        <h6 class="text-center mb-0 text-white">Bukti Pengiriman</h6>
                    </div>
                </div>
                <div class="card shipping-method-choose-card">
                    <div class="card-body">
                        <div class="mb-3">
                            {!! Form::file('bukti_pengiriman', null, ['class' => 'form-control', 'placeholder' => 'Alamat']) !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cart Amount Area-->
            <div class="card cart-amount-area">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <h5 class="total-price mb-0">Rp <span
                            class="counter">{{ cleanNumber($data['cart']->sum('total')) }}</span>
                    </h5>
                    <button type="submit" class="btn btn-warning">Lanjutkan Pemesanan</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection


@section('customjs')
    <script>
        $(document).ready(function() {});
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
