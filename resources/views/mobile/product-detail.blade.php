@extends('layouts.mobile')


@section('content')
    <div class="product-slide-wrapper">
        <!-- Product Slides-->
        <div class="product-slides owl-carousel">
            <!-- Single Hero Slide-->
            <div class="single-product-slide" style="background-image: url('{{ asset('mobile-asset/img/bg-img/6.jpg') }}')">
            </div>
            <!-- Single Hero Slide-->
            <div class="single-product-slide" style="background-image: url('{{ asset('mobile-asset/img/bg-img/10.jpg') }}')">
            </div>
            <!-- Single Hero Slide-->
            <div class="single-product-slide" style="background-image: url('{{ asset('mobile-asset/img/bg-img/11.jpg') }}')">
            </div>
        </div>
        <!-- Video Button-->
        {{-- <a class="video-btn shadow-sm" id="singleProductVideoBtn" href="https://www.youtube.com/watch?v=lFGvqvPh5jI">
            <i class="fa-solid fa-play"></i>
        </a> --}}
    </div>
    <div class="product-description pb-3">
        <!-- Product Title & Meta Data-->
        <div class="product-title-meta-data bg-white mb-3 py-3">
            <div class="container d-flex justify-content-between rtl-flex-d-row-r">
                <div class="p-title-price">
                    <h5 class="mb-1">{{ $item->name }}</h5>
                    <p class="sale-price mb-0 lh-1">Rp {{ cleanNumber($item->harga) }}</p>
                </div>
            </div>
        </div>
        <!-- Selection Panel-->
        <div class="selection-panel bg-white mb-3 py-3">
            <div class="container d-flex align-items-center justify-content-between">
                <!-- Choose Size-->
                <div class="choose-size-wrapper">
                    <p class="mb-1 font-weight-bold">Size</p>
                    <div class="choose-size-radio d-flex align-items-center">
                        @foreach ($data['size'] as $merchId => $size)
                            <!-- Single Radio Input-->
                            <div class="form-check mb-0 me-2">
                                <input class="form-check-input size-product" id="size-product-{{ $merchId }}"
                                    type="radio" name="size" value="{{ $merchId }}"
                                    {{ $item->size == $size ? 'checked' : '' }}>
                                <label class="form-check-label"
                                    for="size-product-{{ $merchId }}">{{ $size }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- Add To Cart-->

        <div class="cart-form-wrapper bg-white mb-3 py-3">
            <div class="container">
                <form class="cart-form" action="#" method="">
                    <div class="order-plus-minus d-flex align-items-center">
                        <div class="quantity-button-handler">-</div>
                        <input class="form-control cart-quantity-input" type="text" step="1" name="quantity"
                            value="3">
                        <div class="quantity-button-handler">+</div>
                    </div>
                    <button class="btn btn-danger ms-3" onclick="addToCart(event)">Add To Cart</button>
                </form>
            </div>
        </div>
        <!-- Product Specification-->
        <div class="p-specification bg-white mb-3 py-3">
            <div class="container">
                <h6>Description</h6>
                <p>{{ $item->text }}</p>
            </div>
        </div>
        <div class="pb-3"></div>
    </div>
@endsection


@section('customjs')
    <script>
        function addToCart(e) {
            var merchId = $('.size-product:checked').val();
            let qty = $('.cart-quantity-input').val();
            var errorMessage = '';
            var isValid = true;


            if (merchId == '') {
                var isValid = false;
                errorMessage += 'Size harus dipilih.\n';
            }

            if (qty == '') {
                var isValid = false;
                errorMessage += 'Qty harus diisi.\n';
            }


            if (!isValid) {
                Swal.fire({
                    icon: 'error',
                    text: errorMessage,
                    toast: true,
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                })
                return;
            } else {
                Swal.fire({
                    toast: true,
                    icon: 'question',
                    title: 'Masukan ke keranjang?',
                    showCancelButton: true,
                    confirmButtonText: 'Confirm',
                    reverseButtons: true,
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        return $.ajax({
                            type: 'POST',
                            url: '{{ route('mobile.cart-store') }}',
                            data: {
                                merch_id: merchId,
                                qty: qty,
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
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.onmouseenter = Swal.stopTimer;
                                    toast.onmouseleave = Swal.resumeTimer;
                                }
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
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.onmouseenter = Swal.stopTimer;
                                    toast.onmouseleave = Swal.resumeTimer;
                                }
                            })
                        } else {
                            Swal.fire({
                                toast: true,
                                title: 'Error',
                                text: result.value.msg.substring(0, 160),
                                icon: 'error',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.onmouseenter = Swal.stopTimer;
                                    toast.onmouseleave = Swal.resumeTimer;
                                }
                            })
                        }
                })
            }


            e.preventDefault();
        }
    </script>
@endsection
