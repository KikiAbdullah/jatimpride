@extends('front.layout')

@section('content')
    <!-- Team Section -->
    <section id="team" class="team section mt-5">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Crew</h2>
            <p>our Crew</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-4">

                @foreach ($data['list_crew'] as $crew)
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                        <div class="team-member">
                            <div class="member-img">
                                <img src="{{ $crew->foto_url }}" class="img-fluid" alt="">
                                <div class="social">
                                    @if (!empty($crew->instagram))
                                        <a href="{{ $crew->instagram ?? '' }}" target="_blank"><i
                                                class="bi bi-instagram"></i>
                                        </a>
                                    @endif
                                    @if (!empty($crew->facebook))
                                        <a href="{{ $crew->facebook ?? '' }}" target="_blank"><i class="bi bi-facebook"></i>
                                        </a>
                                    @endif
                                    @if (!empty($crew->linkedin))
                                        <a href="{{ $crew->linkedin ?? '' }}" target="_blank"><i class="bi bi-linkedin"></i>
                                        </a>
                                    @endif
                                    @if (!empty($crew->whatsapp))
                                        <a href="{{ $crew->whatsapp ?? '' }}" target="_blank"><i class="bi bi-whatsapp"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>{{ $crew->name ?? '' }}</h4>
                                <span>{{ $crew->jabatan }}</span>
                            </div>
                        </div>
                    </div><!-- End Team Member -->
                @endforeach
            </div>

        </div>

    </section><!-- /Team Section -->
@endsection
