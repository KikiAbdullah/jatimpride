@extends('front.layout')

@section('content')
    <!-- Portfolio Details Section -->
    <section id="portfolio-details" style="padding-top:100px; " class="portfolio-details section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4">

                <div class="col-lg-5">
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

                            <div class="swiper-slide">
                                <img src="{{ asset('front-asset/img/portfolio/app-1.jpg') }}" alt="">
                            </div>

                            <div class="swiper-slide">
                                <img src="{{ asset('front-asset/img/portfolio/product-1.jpg') }}" alt="">
                            </div>

                            <div class="swiper-slide">
                                <img src="{{ asset('front-asset/img/portfolio/branding-1.jpg') }}" alt="">
                            </div>

                            <div class="swiper-slide">
                                <img src="{{ asset('front-asset/img/portfolio/books-1.jpg') }}" alt="">
                            </div>

                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="portfolio-info" data-aos="fade-up" data-aos-delay="200">
                        <h3>{{ $item->name ?? '' }}</h3>
                        <ul>
                            <li><strong>Size</strong>: {{ $list_size }}</li>
                            <li><strong>Harga</strong>: {{ $harga }}</li>
                        </ul>
                        <p>
                            Autem ipsum nam porro corporis rerum. Quis eos dolorem eos itaque inventore commodi labore quia
                            quia. Exercitationem repudiandae officiis neque suscipit non officia eaque itaque enim.
                            Voluptatem officia accusantium nesciunt est omnis tempora consectetur dignissimos. Sequi nulla
                            at esse enim cum deserunt eius.
                        </p>
                        <br>
                        <a class="btn-location text-white" href="{{ route('front.order') }}">Beli Sekarang</a>
                    </div>
                </div>

            </div>

        </div>

    </section><!-- /Portfolio Details Section -->
@endsection
