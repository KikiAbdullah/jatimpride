@extends('layouts.mobile')


@section('content')
    <div class="container  py-3">
        <div class="section-heading d-flex align-items-center justify-content-between">
            <h6>Riwayat Pemesanan</h6>
        </div>

        <!-- Cart Wrapper-->
        <div class="cart-wrapper-area">
            <div class="cart-table card mb-3">
                <div class="table-responsive card-body">
                    <table class="table mb-0" width="100%">
                        <tbody>
                            @forelse ($items as $item)
                                <tr>
                                    <td class="text-center">
                                        {!! $item->status_icon_mobile !!}
                                    </td>
                                    <td>
                                        <a href="{{ route('mobile.history-detail', $item->id) }}">
                                            {{ $item->no }}
                                        </a>
                                        <br>
                                        {!! $item->status_formatted !!}
                                    </td>
                                    <td>
                                        <div class="text-end">
                                            <span class="fw-semibold">
                                                Rp {{ cleanNumber($item->lines->sum('total')) }}
                                            </span>
                                            <br>
                                            <small>{{ $item->created_at->format('d/m/Y H:i:s') }}</small>
                                        </div>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td>Belum Ada Transaksi</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
