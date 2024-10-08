@extends('front.layout')

@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">
        <img src="{{ asset('app_local/img/slide/1.png') }}" class="hero-img" alt="" data-aos="fade-in" />

        <div class="container">
            <div class="row justify-content-center text-center" data-aos="fade-up" data-aos-delay="100">
                <div class="col-xl-6 col-lg-8">
                    <img src="{{ setting('event_logo_url') ?? '' }}" class="img-fluid" st alt="" />

                    <div class="row gy-4 justify-content-center" data-aos="fade-up" data-aos-delay="200">
                        <div class="col-3" data-aos="fade-up" data-aos-delay="300">
                            <div class="icon-box">
                                <h1><a href="#!" id="days">0</a></h1>

                                <h3><a href="#!">Hari</a></h3>

                            </div>
                        </div>
                        <div class="col-3" data-aos="fade-up" data-aos-delay="400">
                            <div class="icon-box">
                                <h1><a href="#!" id="hours">0</a></h1>
                                <h3><a href="#!">Jam</a></h3>
                            </div>
                        </div>
                        <div class="col-3" data-aos="fade-up" data-aos-delay="500">
                            <div class="icon-box">
                                <h1><a href="#!" id="minutes">0</a></h1>

                                <h3><a href="#!">Menit</a></h3>
                            </div>
                        </div>
                        <div class="col-3" data-aos="fade-up" data-aos-delay="600">
                            <div class="icon-box">
                                <h1><a href="#!" id="seconds">0</a></h1>

                                <h3><a href="#!">Detik</a></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 text-center">
                    <br>
                    <a class="btn-location text-white" href="{{ setting('event_gmaps') ?? '' }}" target="_blank">Lihat
                        Lokasi
                        Acara</a>
                </div>
            </div>


        </div>
    </section>
    <!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">
                <div class="col-lg-3">
                    <!-- Section Title -->
                    <img src="{{ setting('about_foto_url') ?? '' }}" class="img-fluid" alt="" />
                    <div class="container section-title mt-3" data-aos="fade-up">
                        <h6>{{ setting('about_jabatan') ?? '' }}</h6>
                        <p>{{ setting('about_name') ?? '' }}</p>
                    </div>
                </div>
                <div class="col-lg-9 content">

                    <!-- End Section Title -->
                    <p class="text" style="text-align: justify !important;">
                        {!! setting('about_text') ?? '' !!}
                    </p>
                    <br>
                    {{-- <a href="javascript:void(0);" class="read-more">Read more</a> --}}
                </div>
            </div>
        </div>
    </section>
    <!-- /About Section -->

    <!-- merchandise Section -->
    <section id="merchandise" class="services section">
        <!-- Section Title -->
        <div class="container section-title text-center" data-aos="fade-up">
            <h2>Merchandise</h2>
            <p>Official Merchandise</p>
        </div>
        <!-- End Section Title -->

        <div class="container">
            <div class="row gy-4 justify-content-center">
                <div class="col-lg-8 row">
                    <div class="col-lg-6 col-md-6 d-flex justify-content-center align-items-center" data-aos="fade-up"
                        data-aos-delay="100">
                        <img src="{{ setting('merch_foto_1_url') }}" class="img-fluid" alt="">
                    </div>
                    <!-- End Service Item -->

                    <div class="col-lg-6 col-md-6 d-flex justify-content-center align-items-center" data-aos="fade-up"
                        data-aos-delay="200">
                        <img src="{{ setting('merch_foto_2_url') }}" class="img-fluid" alt="">
                    </div>
                    <!-- End Service Item -->

                    <div class="col-lg-12 text-center">
                        <p class="mt-5">{{ setting('merch_text') }}</p>

                        <a class="btn-location text-white" href="{{ route('front.merchandise') }}">Beli Sekarang</a>

                    </div>
                </div>



            </div>
        </div>
    </section>
    <!-- /merchandise Section -->

    <!-- activity Section -->
    <section id="activity" class="portfolio section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Activity</h2>
            <p>Our Activity Concern</p>
        </div>
        <!-- End Section Title -->

        <div class="container">
            <div class="row gy-4" data-aos="fade-up" data-aos-delay="200">
                @foreach ($activity as $kategoriName => $itemAct)
                    <div class="col-lg-6 col-md-6">
                        <div class="portfolio-details-slider swiper init-swiper">

                            <script type="application/json" class="swiper-config">
                                {
                                    "loop": true,
                                    "speed": 600,
                                    "autoplay": {
                                    "delay": 5000
                                    },
                                    "slidesPerView": "auto",
                                    "pagination": {
                                    "el": ".swiper-pagination",
                                    "type": "bullets",
                                    "clickable": true
                                    }
                                }
                                </script>

                            <div class="swiper-wrapper align-items-center">
                                @foreach ($itemAct as $itemAct2)
                                    <div class="swiper-slide">
                                        <figure class="img-hover-text">
                                            <img src="{{ $itemAct2->foto_url }}" class="w-100"
                                                alt="{{ $itemAct2->name ?? '' }}" />
                                            <figcaption>
                                                <h1>{{ $itemAct2->name ?? '' }}</h1>
                                            </figcaption>
                                            <a href="#"></a>
                                        </figure>
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- End Portfolio Container -->
        </div>
    </section>
    <!-- /activity Section -->

    <!-- event Section -->
    <section id="event" class="team section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Event</h2>
            <p>Our Succeed Event</p>
        </div>
        <!-- End Section Title -->

        <div class="container">
            <div class="row justify-content-center gy-4">

                @foreach ($event as $itemEvent)
                    <div class="col-lg-3 col-md-3 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                        <figure class="img-hover-text">
                            <img src="{{ $itemEvent->foto_url ?? '' }}" alt="{{ $itemEvent->name ?? '' }}" />
                            <figcaption>
                                <h1>{{ $itemEvent->name ?? '' }}</h1>
                            </figcaption>
                            <a href="#"></a>
                        </figure>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- /event Section -->


    <!-- Clients Section -->
    <section id="clients" class="clients section">
        <div class="container section-title text-center pb-3" data-aos="fade-up">
            <p>Sponsorship </p>
            <h2></h2>
        </div>
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row justify-content-center gy-4 mb-3">
                @foreach ($sponsor_utama as $itemSponsor)
                    <div class="col-lg-3 col-md-3 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                        <div class="swiper-slide d-flex justify-content-center align-items-center">
                            <a href="{{ $itemSponsor->url }}" target="_blank" rel="noopener noreferrer">
                                <img src="{{ $itemSponsor->foto_url ?? '' }}" alt="{{ $itemSponsor->name ?? '' }}"
                                    class="img-fluid" style="max-height: 200px; max-width:200px;" />
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper init-swiper">
                <script type="application/json" class="swiper-config">
                    {
                        "loop": true,
                        "speed": 600,
                        "autoplay": {
                          "delay": 5000
                        },
                        "slidesPerView": "auto",
                        "pagination": {
                          "el": ".swiper-pagination",
                          "type": "bullets",
                          "clickable": true
                        },
                        "breakpoints": {
                          "320": {
                            "slidesPerView": 2,
                            "spaceBetween": 40
                          },
                          "480": {
                            "slidesPerView": 3,
                            "spaceBetween": 60
                          },
                          "640": {
                            "slidesPerView": 4,
                            "spaceBetween": 80
                          },
                          "992": {
                            "slidesPerView": 6,
                            "spaceBetween": 120
                          }
                        }
                      }
                </script>
                <div class="swiper-wrapper align-items-center text-center">
                    @foreach ($sponsor as $itemSponsor)
                        <div class="swiper-slide text-center">
                            <a href="{{ $itemSponsor->url ?? '#' }}" target="_blank" rel="noopener noreferrer">
                                <img src="{{ $itemSponsor->foto_url ?? '' }}" class="img-fluid"
                                    alt="{{ $itemSponsor->name ?? '' }}" style="max-height: 150px; max-width:150px;" />
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <div class="row justify-content-center my-3 pt-4" data-aos="fade-up">
                <div class="col-md-6">
                    <div class="row justify-content-center">
                        <div class="col-sm-12">
                            <div class="container pb-4 section-title text-center">
                                <p>Team Support</p>
                                <h2></h2>
                            </div>
                        </div>
                        @foreach ($team_support as $team)
                            <div class="col-6">
                                <div class="swiper-slide text-center d-flex justify-content-center align-items-center">
                                    <a href="{{ $team->url ?? '#' }}" target="_blank" rel="noopener noreferrer">
                                        <img src="{{ $team->foto_url ?? '' }}" alt="{{ $team->name ?? '' }}"
                                            style="max-width: 150px; max-height:150px;" class="img-fluid p-3" />
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="row justify-content-center">
                        <div class="col-sm-12">
                            <div class="container pb-4 section-title text-center">
                                <p>FG Support</p>
                                <h2></h2>
                            </div>
                        </div>
                        @foreach ($fg_support as $fg)
                            <div class="col-6">
                                <div class="swiper-slide text-center d-flex justify-content-center align-items-center">
                                    <a href="{{ $fg->url ?? '#' }}" target="_blank" rel="noopener noreferrer">
                                        <img src="{{ $fg->foto_url ?? '' }}" alt="{{ $fg->name ?? '' }}"
                                            style="max-width: 150px; max-height:150px;" class="img-fluid p-3" />
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Clients Section -->
@endsection


@section('customjs')
    <script>
        // Set the date we're counting down to
        var countDownDate = new Date("{{ formatDate('Y-m-d H:i:s', 'Y-m-d\TH:i:s\Z', setting('event_date')) ?? '' }}")
            .getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result in the element with id="demo"
            document.getElementById("days").innerHTML = days;
            document.getElementById("hours").innerHTML = hours;
            document.getElementById("minutes").innerHTML = minutes;
            document.getElementById("seconds").innerHTML = seconds;

            // If the count down is finished, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("days").innerHTML = '0';
                document.getElementById("hours").innerHTML = '0';
                document.getElementById("minutes").innerHTML = '0';
                document.getElementById("seconds").innerHTML = '0';
            }
        }, 1000);


        // document.querySelector('.read-more').addEventListener('click', function() {
        //     var moreText = document.querySelector('.more-text');
        //     var dots = document.querySelector('.dots');
        //     var readMoreLink = this;

        //     if (moreText.style.display === 'none') {
        //         moreText.style.display = 'inline';
        //         dots.style.display = 'none';
        //         readMoreLink.textContent = 'Read less';
        //     } else {
        //         moreText.style.display = 'none';
        //         dots.style.display = 'inline';
        //         readMoreLink.textContent = 'Read more';
        //     }
        // });
    </script>
@endsection
