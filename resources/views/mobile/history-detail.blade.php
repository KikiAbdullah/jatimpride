@extends('layouts.mobile')

@section('content')
    <div class="container">
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
                            <div class="data-content">{{ $item->customer->name ?? '' }}</div>
                        </div>
                        <div class="single-profile-data d-flex align-items-center justify-content-between">
                            <div class="title d-flex align-items-center"><i class="lni lni-envelope"></i><span>Email</span>
                            </div>
                            <div class="data-content">{{ $item->customer->email ?? '' }}</div>
                        </div>
                        <div class="single-profile-data d-flex align-items-center justify-content-between">
                            <div class="title d-flex align-items-center"><i class="lni lni-phone"></i><span>Whatsapp</span>
                            </div>
                            <div class="data-content">{{ $item->customer->nowa ?? '' }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="title mb-2"><i class="lni lni-map-marker"></i><span>Alamat</span></div>
                            <div class="data-content">{{ $item->alamat_prov ?? '' }}</div>
                            <div class="data-content">{{ $item->alamat ?? '' }}</div>
                        </div>

                        <div class="mb-3">
                            <div class="title mb-2"><i class="lni lni-pencil"></i><span>Keterangan</span></div>
                            <div class="data-content">{{ $item->text ?? '' }}</div>
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
                                        <td>
                                            <div class="quantity">
                                                <span>{{ cleanNumber($line->qty) }}</span>
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
                    <h5 class="total-price mb-0">Rp <span
                            class="counter">{{ cleanNumber($item->lines->sum('total')) }}</span>
                    </h5>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('customjs')
@endsection
