@extends('layouts.mobile')


@section('content')
    <div class="container py-3">
        <div class="section-heading d-flex align-items-center justify-content-between">
            <h6>Keranjang</h6>
        </div>

        <div class="cart-wrapper-area">
            <div class="cart-table card mb-3">
                <div class="table-responsive card-body">
                    <table class="table mb-0">
                        <tbody>
                            @forelse ($items as $item)
                                <tr>
                                    <th scope="row" class="text-center">
                                        <a class="remove-product bg-danger"
                                            onclick="RemoveLines('{{ route('mobile.cart-delete', $item->id) }}', event)"
                                            href="#"><i class="fa fa-x"></i></a>
                                    </th>
                                    <td class="text-start">
                                        <a href="{{ route('mobile.product-detail', $item->merch_id) }}">
                                            {{ $item->merch->name ?? '' }} - {{ $item->merch->size ?? '' }}
                                            <span>
                                                Rp {{ cleanNumber($item->merch->harga) }}
                                            </span>
                                        </a>
                                    </td>
                                    <td class="text-end">
                                        <div class="quantity">
                                            <input class="merch-id" type="hidden" value="{{ $item->merch_id }}">
                                            <input class="harga-text" type="hidden" value="{{ $item->merch->harga }}">
                                            <input class="qty-text" type="text" value="{{ $item->qty }}">
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <p>Belum Ada Transaksi</p>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($items->isNotEmpty())
                <!-- Cart Amount Area-->
                <div class="card cart-amount-area">
                    <div class="container py-3">
                        <small><span class="fw-semibold">NB</span>: Sebelum melanjutkan ke pembayaran, pastikan jumlah item
                            terlebih dahulu</small>
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <a class="btn btn-warning" onclick="CheckoutBtn(this, event)">Lanjutkan Pembayaran</a>
                        <h5 class="total-price mb-0">Rp<span class="counter">{{ cleanNumber($items->sum('total')) }}</span>
                        </h5>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection


@section('customjs')
    <script>
        $(document).ready(function() {
            // Fungsi untuk menghitung ulang total harga
            function updateTotalPrice() {
                let totalPrice = 0;

                $('tr').each(function() {
                    const harga = parseFloat($(this).find('.harga-text').val());
                    const qty = parseInt($(this).find('.qty-text').val());

                    if (!isNaN(harga) && !isNaN(qty)) {
                        totalPrice += harga * qty;
                    }
                });

                $('.total-price .counter').text(totalPrice.toLocaleString('id-ID'));
            }

            // Event listener untuk perubahan qty
            $('.qty-text').on('keyup', function() {
                updateTotalPrice();
            });

            // Inisialisasi perhitungan awal
            updateTotalPrice();
        });

        function CheckoutBtn(el, e) {
            let items = [];

            // Iterasi melalui setiap baris di tabel
            $('tr').each(function() {
                const merch_id = $(this).find('.merch-id').val();
                const qty = $(this).find('.qty-text').val();

                if (merch_id && qty) {
                    items.push({
                        merch_id: merch_id,
                        qty: qty
                    });
                }
            });

            if (items.length === 0) {
                Swal.fire({
                    toast: true,
                    title: 'Error',
                    text: 'Keranjang belanja Anda kosong. Tambahkan item sebelum melanjutkan ke pembayaran.',
                    icon: 'error',
                    showConfirmButton: false,
                });
                return;
            }


            Swal.fire({
                toast: true,
                icon: 'question',
                title: 'Lanjutkan ke Pembayaran?',
                showCancelButton: true,
                confirmButtonText: 'Confirm',
                reverseButtons: true,
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return $.ajax({
                        type: 'POST',
                        url: '{{ route('mobile.cart-update') }}',
                        data: {
                            items: items,
                        },
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
                        Swal.fire({
                            toast: true,
                            title: 'Request Error',
                            text: xhr.substring(0, 160),
                            icon: 'error',
                            showConfirmButton: false,
                        })
                    })
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
                        window.location.href = '{{ route('mobile.order') }}';
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

            e.preventDefault();
        }

        const RemoveLines = (url, e) => {

            Swal.fire({
                toast: true,
                icon: 'question',
                title: 'Hapus Item Keranjang?',
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
                        window.location.href = '{{ route('mobile.order') }}';
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
