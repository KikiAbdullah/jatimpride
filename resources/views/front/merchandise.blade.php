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
                            @foreach ($data['list_foto'] as $foto)
                                <div class="swiper-slide">
                                    <img src="{{ $foto->foto_url }}" alt="">
                                </div>
                            @endforeach
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
                            {{ $item->text ?? '' }}
                        </p>
                        <br>
                        <a class="btn-location text-white" href="{{ route('front.order') }}">Beli Sekarang</a>
                    </div>
                </div>

            </div>

        </div>

    </section><!-- /Portfolio Details Section -->
@endsection
