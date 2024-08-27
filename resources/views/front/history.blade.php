@extends('front.layout')

@section('content')
    <!-- Team Section -->
    <section id="contact" class="contact section mt-5">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>HISTORY TRANSACTION</h2>
            <p>{{ $item->no }}</p>
        </div>
        <!-- End Section Title -->

        <div class="container">
            <div class="page-title">
                <nav class="breadcrumbs">
                    <div class="container">
                        <ol>
                            <li><a href="{{ route('front.index') }}">Home</a></li>
                            <li><a href="{{ route('front.profile') }}">Profile</a></li>
                            <li class="current">History</li>
                        </ol>
                    </div>
                </nav>
            </div>

            <div class="row my-3">
                <div class="col-md-6 col-sm-12">
                    <div class="portfolio-details">
                        <div class="portfolio-info aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                            <div class="d-flex justify-content-between">
                                <h3>{{ $item->no }}</h3>

                                <div>
                                    {!! $item->status_formatted !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <ul>
                                        <li><strong>Tanggal</strong>:
                                            {{ $item->created_at->format('d F Y H:i:s') ?? '' }}
                                        </li>
                                        <li><strong>Customer</strong>: {{ $item->customer->name ?? '' }}
                                        </li>
                                        <li>
                                            <strong>Jenis Pengiriman</strong>:
                                            {{ $item->jenisPengiriman->name ?? '' }}<br>
                                            {{ $item->alamat_prov ?? '' }}<br>
                                            {{ $item->alamat ?? '' }}<br>
                                        </li>
                                        @if ($item->status == 'closed' && $item->jenis_pengiriman_id == 1)
                                            <li>
                                                <strong>No Resi</strong>:
                                                {{ $item->noresi ?? '' }}
                                            </li>
                                        @endif
                                        <li><strong>Total</strong>: Rp {{ cleanNumber($item->total) }}
                                        </li>
                                        <li><strong>Catatan</strong>:<br> {{ $item->text }}
                                        </li>
                                        @if ($item->status == 'rejected')
                                            <li><strong>Alasan Reject</strong>:<br> {{ $item->text_reject }}
                                            </li>
                                        @endif
                                    </ul>
                                    @if ($item->status == 'open')
                                        <button
                                            onclick="BatalPemesanan('{{ route('front.reject', $item->id) }}', event)"class="btn btn-danger">Batalkan
                                            Pesanan</button>
                                    @else
                                        <div></div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
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
                            Swal.fire({
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
                        window.location.href = "";

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
