<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, viewport-fit=cover, shrink-to-fit=no">
    <meta name="description" content="{{ env('APP_NAME') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#100DD1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!-- The above tags *must* come first in the head, any other head content must come *after* these tags -->
    <!-- Title -->
    <title>{{ env('APP_NAME') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&amp;display=swap"
        rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('app_local/img/favicon.png') }}">
    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" href="{{ asset('app_local/img/favicon.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('app_local/img/favicon.png') }}">
    <link rel="apple-touch-icon" sizes="167x167" href="{{ asset('app_local/img/favicon.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('app_local/img/favicon.png') }}">
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('mobile-asset/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('mobile-asset/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('mobile-asset/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('mobile-asset/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('mobile-asset/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('mobile-asset/css/lineicons.min.css') }}">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/brands.min.css"
        integrity="sha512-EJp8vMVhYl7tBFE2rgNGb//drnr1+6XKMvTyamMS34YwOEFohhWkGq13tPWnK0FbjSS6D8YoA3n3bZmb3KiUYA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/fontawesome.min.css"
        integrity="sha512-B46MVOJpI6RBsdcU307elYeStF2JKT87SsHZfRSkjVi4/iZ3912zXi45X5/CBr/GbCyLx6M1GQtTKYRd52Jxgw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/regular.min.css"
        integrity="sha512-j+P0XpTXw+hDTK64xqC/cjv62cf629/IR4/0bokmich7J8XdVlWT40+1M/Z58rCQ4F+3QoJIfzh6Ui6TTIP6WQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/solid.min.css"
        integrity="sha512-/r+0SvLvMMSIf41xiuy19aNkXxI+3zb/BN8K9lnDDWI09VM0dwgTMzK7Qi5vv5macJ3VH4XZXr60ip7v13QnmQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ asset('mobile-asset/style.css') }}">

    @yield('customcss')
    <!-- Web App Manifest -->
    <link rel="manifest" href="{{ asset('mobile-asset/manifest.json') }}">

    <script src="{{ asset('mobile-asset/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('mobile-asset/js/jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        const _csrf_token = "{{ csrf_token() }}";
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': _csrf_token
                }
            });
        });
    </script>
</head>

<body>
    <!-- Header Area -->
    <div class="header-area" id="headerArea">
        <div class="container h-100 d-flex align-items-center justify-content-between d-flex rtl-flex-d-row-r">
            <!-- Logo Wrapper -->
            <div class="logo-wrapper"><a href="{{ route('mobile.index') }}"><img
                        src="{{ asset('app_local/img/logo.png') }}" class="img-fluid" style="max-height: 50px;"
                        alt=""></a>
            </div>
        </div>
    </div>
    <!-- PWA Install Alert -->
    <div class="page-content-wrapper">
        <div class="container">
            {!! Form::open(['route' => 'mobile.register-store', 'method' => 'POST', 'id' => 'dform']) !!}
            <!-- Checkout Wrapper-->
            <div class="checkout-wrapper-area py-3">
                <!-- Billing Address-->
                <div class="billing-information-card mb-3">
                    <div class="card billing-information-title-card bg-warning">
                        <div class="card-body text-center">
                            <h6 class="text-center mb-0">Register</h6>
                        </div>
                    </div>
                    <div class="card user-data-card">
                        <div class="card-body">
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        {!! $error . '<br/>' !!}
                                    @endforeach
                                </div>
                            @endif
                            <div class="mb-3">
                                <div class="title mb-2"><i class="lni lni-user"></i><span>Username</span>
                                </div>
                                {!! Form::text('username', null, [
                                    'class' => in_array('username', $errors->keys()) ? 'form-control is-invalid' : 'form-control',
                                    'placeholder' => 'Username',
                                ]) !!}
                            </div>
                            <div class="mb-3">
                                <div class="title mb-2"><i class="lni lni-user"></i><span>Nama
                                        Lengkap</span>
                                </div>
                                {!! Form::text('name', null, [
                                    'class' => in_array('name', $errors->keys()) ? 'form-control is-invalid' : 'form-control',
                                    'placeholder' => 'Name',
                                ]) !!}
                            </div>
                            <div class="mb-3">
                                <div class="title mb-2"><i class="lni lni-envelope"></i><span>Email</span>
                                </div>
                                {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                            </div>
                            <div class="mb-3">
                                <div class="title mb-2"><i class="lni lni-phone"></i><span>Whatsapp</span>
                                </div>
                                {!! Form::text('nowa', null, ['class' => 'form-control', 'placeholder' => 'WhatsApp Number']) !!}
                            </div>

                            <div class="mb-3">
                                <div class="title mb-2"><i class="lni lni-pencil"></i><span>Password</span></div>
                                {!! Form::password('password', [
                                    'class' => in_array('password', $errors->keys()) ? 'form-control is-invalid' : 'form-control',
                                    'placeholder' => 'Password',
                                ]) !!}
                            </div>
                        </div>
                        <!-- Cart Amount Area-->
                        <div class="card cart-amount-area">
                            <div class="card-body mb-2 justify-content-between">
                                <a href="{{ route('mobile.index') }}" class="btn btn-danger">Batal</a>
                                <button type="submit" class="btn btn-primary">Register</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

    <!-- All JavaScript Files-->

    <script src="{{ asset('mobile-asset/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('mobile-asset/js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('mobile-asset/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('mobile-asset/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('mobile-asset/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('mobile-asset/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('mobile-asset/js/jquery.passwordstrength.js') }}"></script>
    <script src="{{ asset('mobile-asset/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('mobile-asset/js/theme-switching.js') }}"></script>
    <script src="{{ asset('mobile-asset/js/no-internet.js') }}"></script>
    <script src="{{ asset('mobile-asset/js/active.js') }}"></script>
    <script src="{{ asset('mobile-asset/js/pwa.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    @yield('customjs')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js"
        integrity="sha512-6sSYJqDreZRZGkJ3b+YfdhB3MzmuP9R7X1QZ6g5aIXhRvR1Y/N/P47jmnkENm7YL3oqsmI6AK+V6AD99uWDnIw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/brands.min.js"
        integrity="sha512-N5K6sQXjzT79tR16zvBu7B0AqvYtHKvk3+eKuQWoVNQDGU5kR9W8OP3CTYtm3vVM2EtObrmtm0Jup17F718OyA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/brands.min.js"
        integrity="sha512-N5K6sQXjzT79tR16zvBu7B0AqvYtHKvk3+eKuQWoVNQDGU5kR9W8OP3CTYtm3vVM2EtObrmtm0Jup17F718OyA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/fontawesome.min.js"
        integrity="sha512-NeFv3hB6XGV+0y96NVxoWIkhrs1eC3KXBJ9OJiTFktvbzJ/0Kk7Rmm9hJ2/c2wJjy6wG0a0lIgehHjCTDLRwWw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/regular.min.js"
        integrity="sha512-kOmvRi+0imoekwslOzP/X1LXQnzcttzqYYt3urKD4nhd5fMYwRfXgDS5Nh7b7pQjKPjBPSX9PmhCLrkfkxUcBQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/solid.min.js"
        integrity="sha512-L2znesU64H/rvdnaD4WBaRAmEcGvhBsVLXygPkhpgpUwcgjymD4amy68shdgZgLiIvyvV/vHRXAM4mTV8xqp+Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>
