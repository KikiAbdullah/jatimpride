@extends('layouts.mobile')


@section('content')
    <!-- Hero Wrapper -->
    <div class="hero-wrapper">
        <div class="container">
            <div class="pt-3">
                <!-- Hero Slides-->
                <div class="hero-slides owl-carousel">
                    <!-- Single Hero Slide-->
                    <div class="single-hero-slide"
                        style="background-image: url('{{ asset('mobile-asset/img/bg-img/1.jpg') }}')">
                        <div class="slide-content h-100 d-flex align-items-center">
                            <div class="slide-text">
                                <h4 class="text-white mb-0" data-animation="fadeInUp" data-delay="100ms"
                                    data-duration="1000ms">Amazon Echo</h4>
                                <p class="text-white" data-animation="fadeInUp" data-delay="400ms" data-duration="1000ms">
                                    3rd Generation, Charcoal</p><a class="btn btn-primary" href="#"
                                    data-animation="fadeInUp" data-delay="800ms" data-duration="1000ms">Buy Now</a>
                            </div>
                        </div>
                    </div>
                    <!-- Single Hero Slide-->
                    <div class="single-hero-slide"
                        style="background-image: url('{{ asset('mobile-asset/img/bg-img/2.jpg') }}')">
                        <div class="slide-content h-100 d-flex align-items-center">
                            <div class="slide-text">
                                <h4 class="text-white mb-0" data-animation="fadeInUp" data-delay="100ms"
                                    data-duration="1000ms">Light Candle</h4>
                                <p class="text-white" data-animation="fadeInUp" data-delay="400ms" data-duration="1000ms">
                                    Now only $22</p><a class="btn btn-success" href="#" data-animation="fadeInUp"
                                    data-delay="500ms" data-duration="1000ms">Buy Now</a>
                            </div>
                        </div>
                    </div>
                    <!-- Single Hero Slide-->
                    <div class="single-hero-slide"
                        style="background-image: url('{{ asset('mobile-asset/img/bg-img/3.jpg') }}')">
                        <div class="slide-content h-100 d-flex align-items-center">
                            <div class="slide-text">
                                <h4 class="text-white mb-0" data-animation="fadeInUp" data-delay="100ms"
                                    data-duration="1000ms">Best Furniture</h4>
                                <p class="text-white" data-animation="fadeInUp" data-delay="400ms" data-duration="1000ms">3
                                    years warranty</p><a class="btn btn-danger" href="#" data-animation="fadeInUp"
                                    data-delay="800ms" data-duration="1000ms">Buy Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Dark Mode -->
    <div class="container">
        <div class="dark-mode-wrapper mt-3 bg-img p-4 p-lg-5">
            <div class="form-check form-switch mb-0">
                <label class="form-check-label text-white h6 mb-0" for="darkSwitch">Switch to Dark Mode</label>
                <input class="form-check-input" id="darkSwitch" type="checkbox" role="switch">
            </div>
        </div>
    </div>
    <!-- Top Products -->
    <div class="top-products-area py-3">
        <div class="container">
            <div class="section-heading d-flex align-items-center justify-content-between dir-rtl">
                <h6>Merchandise</h6>
            </div>
            <div class="row g-2">
                <!-- Product Card -->
                <div class="col-12">
                    <div class="card product-card">
                        <div class="card-body">
                            <!-- Thumbnail -->
                            <a class="product-thumbnail d-block" href="{{ route('mobile.product-detail', 1) }}"><img
                                    class="mb-2" src="{{ asset('mobile-asset/img/product/11.png') }}" alt="">
                            </a>
                            <!-- Product Title --><a class="product-title" href="{{ route('mobile.product-detail', 1) }}">
                                Merchandise JATIMPRIDE 4
                            </a>
                            <!-- Product Price -->
                            <p class="sale-price">Rp 150.000</p>
                            <!-- Rating -->
                        </div>
                        <!-- Add to Cart --><a class="btn btn-success btn-sm"
                            href="{{ route('mobile.product-detail', 1) }}"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pb-3">
        <div class="container">
            <div class="discount-coupon-card p-4 p-lg-5 dir-rtl">
                <div class="d-flex align-items-center">
                    <div class="discountIcon"><img class="w-100"
                            src="{{ asset('mobile-asset/img/core-img/discount.png') }}" alt="">
                    </div>
                    <div class="text-content">
                        <h4 class="text-white mb-1">Get 20% discount!</h4>
                        <p class="text-white mb-0">To get discount, enter the<span class="px-1 fw-bold">GET20</span>code
                            on the checkout page.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
