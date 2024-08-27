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
            <div class="page-title">
                <nav class="breadcrumbs">
                    <div class="container">
                        <ol>
                            <li><a href="{{ route('front.index') }}">Home</a></li>
                            <li class="current">Profile</li>
                        </ol>
                    </div>
                </nav>
            </div>

            <div class="row my-3">
                <div class="col-lg-12">
                    <div class="container">
                        <div class="d-flex flex-column flex-lg-row align-items-start">
                            <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                <button class="nav-link active" id="v-pills-profile-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-profile" type="button" role="tab"
                                    aria-controls="v-pills-profile" aria-selected="true">
                                    <i class="bi bi-person-circle me-2"></i>Profile
                                </button>
                                <button class="nav-link" id="v-pills-history-tab" data-bs-toggle="pill"
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
                                <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel"
                                    aria-labelledby="v-pills-profile-tab" tabindex="0">
                                    <div class="portfolio-details">
                                        <div class="portfolio-info aos-init aos-animate" data-aos="fade-up"
                                            data-aos-delay="200">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <table width="100%">
                                                        <tr>
                                                            <th width="20%" class="text-end">Name</th>
                                                            <td></td>
                                                            <td>: {{ auth()->user()->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th width="20%" class="text-end">Email</th>
                                                            <td></td>
                                                            <td>: {{ auth()->user()->email }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th width="20%" class="text-end">Whatsapp</th>
                                                            <td></td>
                                                            <td>: {{ auth()->user()->nowa }}</td>
                                                        </tr>
                                                        {{-- <tr>
                                                            <th colspan="3" class="text-end">
                                                                <a class="btn-location text-white"
                                                                    href="{{ route('front.profile-edit') }}">Edit</a>
                                                            </th>
                                                        </tr> --}}
                                                    </table>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-history" role="tabpanel"
                                    aria-labelledby="v-pills-history-tab" tabindex="0">
                                    @forelse ($data['history'] as $history)
                                        <div class="portfolio-details">
                                            <div class="portfolio-info aos-init aos-animate" data-aos="fade-up"
                                                data-aos-delay="200">
                                                <div class="d-flex justify-content-between">
                                                    <h3>{{ $history->no }}</h3>
                                                    <div>{!! $history->status_formatted !!}</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <ul>
                                                            <li><strong>Tanggal</strong>:
                                                                {{ $history->created_at->format('d F Y H:i:s') ?? '' }}</li>
                                                            <li><strong>Customer</strong>:
                                                                {{ $history->customer->name ?? '' }}</li>
                                                            <li><strong>Jenis Pengiriman</strong>:
                                                                {{ $history->jenisPengiriman->name ?? '' }}<br>
                                                                {{ $history->alamat_prov ?? '' }}<br>
                                                                {{ $history->alamat ?? '' }}<br>
                                                            </li>
                                                            @if ($history->status == 'closed' && $history->jenis_pengiriman_id == 1)
                                                                <li>
                                                                    <strong>No Resi</strong>:
                                                                    {{ $history->noresi ?? '' }}
                                                                </li>
                                                            @endif
                                                            <li><strong>Total</strong>: Rp
                                                                {{ cleanNumber($history->total) }}</li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <ul>
                                                            <li><strong>Catatan</strong>:<br> {{ $history->text }}</li>
                                                            @if ($history->status == 'rejected')
                                                                <li><strong>Alasan Reject</strong>:<br>
                                                                    {{ $history->text_reject }}</li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-12 text-end">
                                                        <a class="btn-location text-white"
                                                            href="{{ route('front.history', $history->id) }}">Detail</a>
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
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </section><!-- /Team Section -->
@endsection
