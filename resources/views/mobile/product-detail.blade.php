@extends('layouts.mobile')


@section('content')
    <div class="product-slide-wrapper">
        <!-- Product Slides-->
        <div class="product-slides owl-carousel">

            <!-- Single Hero Slide-->
            <div class="single-product-slide"
                style="background-image: url('{{ $item->thumb_mobile }}');background-size: contain;background-repeat: no-repeat;">
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
                    <h5 class="mb-1">{{ $item->name_size }}</h5>
                    <p class="sale-price mb-0 lh-1">Rp {{ cleanNumber($item->harga) }}</p>
                </div>
            </div>
        </div>
        <!-- Selection Panel-->

        <div class="cart-form-wrapper bg-white mb-3 py-3">
            <div class="container">
                <form class="cart-form" action="#" method="">
                    <div class="order-plus-minus d-flex align-items-center">
                        <div class="quantity-button-handler">-</div>
                        <input class="form-control cart-quantity-input" type="text" step="1" name="quantity"
                            value="1">
                        <div class="quantity-button-handler">+</div>
                    </div>
                    <button class="btn btn-danger ms-3" onclick="addToCart('{{ $item->id }}',event)">Add To
                        Cart</button>
                </form>
            </div>
        </div>
        <!-- Product Specification-->
        <div class="p-specification bg-white mb-3 py-3">
            <div class="container">
                <h6>Description</h6>
                <span>{{ $item->text }}</span>
            </div>
        </div>
        <div class="bg-white mb-3 py-3">
            <div class="container">
                <div class="section-heading d-flex align-items-center justify-content-between">
                    <h6>Related Products</h6>
                </div>
                <div class="row g-2 rtl-flex-d-row-r">

                    @foreach ($data['list_product'] as $product)
                        <!-- Product Card -->
                        <div class="col-6 col-md-4">
                            <div class="card product-card">
                                <div class="card-body">
                                    <a class="product-thumbnail d-block"
                                        href="{{ route('mobile.product-detail', $product->id) }}">
                                        <img class="mb-2" src="{{ $product->thumb_mobile }}" alt="">
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
        </div>

    </div>
@endsection


@section('customjs')
    <script>
        function addToCart(merchId, e) {
            let qty = $('.cart-quantity-input').val();
            var errorMessage = '';
            var isValid = true;

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
