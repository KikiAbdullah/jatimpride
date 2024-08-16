@extends('layouts.mobile')

@section('content')
    <div class="container">
        <!-- Checkout Wrapper-->
        <div class="checkout-wrapper-area py-3">
            <!-- Billing Address-->
            <div class="billing-information-card mb-3">
                <div class="card billing-information-title-card bg-warning">
                    <div class="card-body">
                        <h6 class="text-center mb-0 ">Detail Transaksi</h6>
                    </div>
                </div>
                <div class="card user-data-card">
                    <div class="card-body">
                        <div class="single-profile-data d-flex align-items-center justify-content-between">
                            <div class="title d-flex align-items-center"><span></span>
                            </div>
                            <div class="data-content fs-lg fw-semibold">{{ $item->no ?? '' }}</div>
                        </div>
                        <div class="single-profile-data d-flex align-items-center justify-content-between">
                            <div class="title d-flex align-items-center"><span>Tanggal</span>
                            </div>
                            <div class="data-content">{{ $item->created_at->format('d/m/Y H:i:s') ?? '' }}</div>
                        </div>
                        <div class="single-profile-data d-flex align-items-center justify-content-between">
                            <div class="title d-flex align-items-center"><span>Jenis Pengiriman</span>
                            </div>
                            <div class="data-content">
                                <span class="fw-semibold">{{ $item->jenisPengiriman->name ?? '' }}</span>
                                <br>
                                <small> {{ $item->jenisPengiriman->text ?? '' }}</small>
                            </div>
                        </div>
                        @if ($item->jenis_pengiriman_id == 1)
                            <div class="single-profile-data d-flex align-items-center justify-content-between">
                                <div class="title d-flex align-items-center"><span>Alamat</span>
                                </div>
                                <div class="data-content">
                                    <span class="fw-semibold">{{ $item->alamat_prov ?? '' }}</span>
                                    <br>
                                    <small> {{ $item->alamat ?? '' }}</small>
                                </div>
                            </div>
                        @endif
                        <div class="single-profile-data d-flex align-items-center justify-content-between">
                            <div class="title d-flex align-items-center"><span>Keterangan</span>
                            </div>
                            <div class="data-content">{!! $item->text ?? '' !!}</div>
                        </div>
                        <div class="single-profile-data d-flex align-items-center justify-content-between">
                            <div class="title d-flex align-items-center"><span>Status</span>
                            </div>
                            <div class="data-content">
                                {!! $item->status_formatted ?? '' !!}
                                @if ($item->status == 'rejected')
                                    <br><small>{{ $item->text_reject ?? '' }}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="cart-wrapper-area py-3">
                <div class="cart-table card mb-3">
                    <div class="table-responsive card-body">
                        <table class="table mb-0">
                            <tbody>
                                @foreach ($item->lines as $line)
                                    <tr>
                                        <td>
                                            <a href="{{ route('mobile.product-detail', $line->merch_id) }}">
                                                {{ $line->merch->name ?? '' }} - {{ $line->merch->size ?? '' }}
                                                <span>
                                                    Rp {{ cleanNumber($line->merch->harga) }}
                                                </span>
                                            </a>
                                        </td>
                                        <td class="text-end">
                                            <div class="quantity">
                                                <span>{{ cleanNumber($line->qty) }} Pcs</span>
                                            </div>
                                        </td>
                                        <td class="text-end">
                                            <div class="quantity">
                                                <span>{{ cleanNumber($line->total) }}</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Cart Amount Area-->
            <div class="card cart-amount-area">
                <div class="card-body d-flex align-items-center justify-content-between">
                    @if ($item->status == 'open')
                        <button
                            onclick="BatalPemesanan('{{ route('mobile.history-reject', $item->id) }}', event)"class="btn btn-danger">Batalkan
                            Pesanan</button>
                    @else
                        <div></div>
                    @endif

                    <h5 class="total-price mb-0">Rp <span
                            class="counter">{{ cleanNumber($item->lines->sum('total')) }}</span>
                    </h5>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('customjs')
    <script>
        const BatalPemesanan = (url, e) => {

            Swal.fire({
                toast: true,
                icon: 'question',
                title: 'Batalkan Pemesanan?',
                showCancelButton: true,
                confirmButtonText: 'Confirm',
                reverseButtons: true,
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    $.ajax({
                            type: 'GET',
                            url: url,
                            dataType: "json",
                            success: () => {
                                window.location.href = "";
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
                            swalInit.fire({
                                title: "Request Error",
                                toast: true,
                                text: xhr.substring(0, 160),
                                icon: "error",
                            });
                        });
                },
                allowOutsideClick: false
            }).then((result) => {
                if (result.value != null)
                    if (result.value.status) {
                        Swal.fire({
                            toast: true,
                            title: 'Success',
                            text: result.value.msg,
                            icon: 'success',
                            showConfirmButton: false,
                        });
                        window.location.href = '{{ route('mobile.history') }}';
                    } else {
                        Swal.fire({
                            toast: true,
                            title: 'Error',
                            text: result.value.msg.substring(0, 160),
                            icon: 'error',
                            showConfirmButton: false,
                        })
                    }
            })
        }
    </script>
@endsection
