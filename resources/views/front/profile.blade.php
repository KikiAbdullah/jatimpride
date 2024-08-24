@extends('front.layout')

@section('content')
    <!-- Team Section -->
    <section id="team" class="team section mt-5">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>PROFILE</h2>
            <p>MY PROFILE</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-4">
                <div class="col-lg-12">
                    <div class="d-flex align-items-start">
                        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <button class="nav-link active" id="v-pills-history-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-history" type="button" role="tab"
                                aria-controls="v-pills-history" aria-selected="true">
                                <i class="bi bi-card-checklist me-2"></i>Riwayat
                            </button>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"
                                class="nav-link">
                                <i class="bi bi-box-arrow-right me-2"></i>Log Out
                            </a>
                            <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                        <div class="tab-content w-100" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-history" role="tabpanel"
                                aria-labelledby="v-pills-history-tab" tabindex="0">
                                @forelse ($data['history'] as $history)
                                    <div class="portfolio-details">
                                        <div class="portfolio-info aos-init aos-animate" data-aos="fade-up"
                                            data-aos-delay="200">
                                            <div class="d-flex justify-content-between">
                                                <h3>{{ $history->no }}</h3>

                                                <div>
                                                    {!! $history->status_formatted !!}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <ul>
                                                        <li><strong>Tanggal</strong>:
                                                            {{ $history->created_at->format('d F Y H:i:s') ?? '' }}
                                                        </li>
                                                        <li><strong>Customer</strong>: {{ $history->customer->name ?? '' }}
                                                        </li>
                                                        <li>
                                                            <strong>Jenis Pengiriman</strong>:
                                                            {{ $history->jenisPengiriman->name ?? '' }}
                                                        </li>
                                                        <li><strong>Total</strong>: Rp {{ cleanNumber($history->total) }}
                                                        </li>
                                                        <li><strong>Catatan</strong>:<br> {{ $history->text }}
                                                        </li>
                                                    </ul>
                                                    <a class="btn-location text-white"
                                                        href="{{ route('front.history', $history->id) }}">Detail</a>
                                                </div>
                                                <div class="col-lg-6">
                                                    @foreach ($history->lines as $item)
                                                        <div class="callout callout-primary">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class="ticket-category text-grey">
                                                                        {{ $item->merch->name_size }}</div>
                                                                    <div class="ticket-category-qty">
                                                                        {{ $item->harga_formatted }} x
                                                                        {{ $item->qty }}</div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <h6 class="float-end">{{ $item->total_formatted }}</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                    @endforeach
                                                </div>


                                            </div>

                                        </div>
                                    </div>
                                @empty
                                    <div class="portfolio-details">
                                        <div class="portfolio-info aos-init aos-animate" data-aos="fade-up"
                                            data-aos-delay="200">
                                            <h3>Belum Memiliki Riwayat Transaksi</h3>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                            <div class="tab-pane fade show" id="v-pills-cart" role="tabpanel"
                                aria-labelledby="v-pills-cart-tab" tabindex="0">
                                <div class="card">
                                    <div class="card-body">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique earum explicabo
                                        corrupti rerum fugit neque saepe? Eligendi, minima, porro dolor aperiam, qui esse
                                        magnam maiores quae odio repellat reiciendis ipsum.
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
