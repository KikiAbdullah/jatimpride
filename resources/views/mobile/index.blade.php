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
                        style="background-image: url('{{ asset('app_local/img/slide/1.png') }}'); background-color:black;">
                        <div class="slide-content h-100 d-flex align-items-center">
                        </div>
                    </div>

                    @for ($i = 1; $i <= 4; $i++)
                        <div class="single-hero-slide"
                            style="background-image: url('{{ asset('app_local/img/slide/' . $i . '.jpg') }}'); background-color:black;">
                            <div class="slide-content h-100 d-flex align-items-center">
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="dark-mode-wrapper mt-3 bg-img p-4 p-lg-5">
            <div class="form-check form-switch mb-0">
                <label class="form-check-label text-white h6 mb-0" for="darkSwitch">Switch to Dark Mode</label>
                <input class="form-check-input" id="darkSwitch" type="checkbox" role="switch">
            </div>
        </div>
    </div>
    <div class="container py-3">
        <img class="mb-4" src="{{ asset('app_local/img/size-chart.jpg') }}" alt="">
    </div>
    <div class="container py-3">
        <div class="section-heading d-flex align-items-center justify-content-between">
            <h6>Merchandise</h6>
        </div>
        <div class="row g-2 rtl-flex-d-row-r">

            @foreach ($data['list_product'] as $product)
                <!-- Product Card -->
                <div class="col-6 col-md-4">
                    <div class="card product-card">
                        <div class="card-body">
                            <a class="product-thumbnail d-block" href="{{ route('mobile.product-detail', $product->id) }}">
                                <img class="mb-2" src="{{ $product->thumb_mobile ?? '' }}" alt="">
                            </a>
                            <!-- Product Title --><a class="product-title"
                                href="{{ route('mobile.product-detail', $product->id) }}">{{ $product->name_size }}</a>
                            <!-- Product Price -->
                            <p class="sale-price">{{ $product->harga_formatted }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
