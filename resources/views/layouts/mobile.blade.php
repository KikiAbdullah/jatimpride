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
    <title>{{ $title ?? (env('APP_NAME') ?? '') }}</title>
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
                        src="{{ asset('app_local/img/logo.png') }}" class="img-fluid" style="max-height: 30px;"
                        alt=""></a>
            </div>
            <div class="navbar-logo-container d-flex align-items-center">
                <!-- Navbar Toggler -->
                <div class="suha-navbar-toggler ms-2" data-bs-toggle="offcanvas" data-bs-target="#suhaOffcanvas"
                    aria-controls="suhaOffcanvas">
                    <div><span></span><span></span><span></span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="offcanvas offcanvas-start suha-offcanvas-wrap" tabindex="-1" id="suhaOffcanvas"
        aria-labelledby="suhaOffcanvasLabel">
        <!-- Close button-->
        <button class="btn-close btn-close-white" type="button" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
        <!-- Offcanvas body-->
        <div class="offcanvas-body">
            <!-- Sidenav Profile-->
            <div class="sidenav-profile">
                <div class="user-info">
                    <img src="{{ asset('app_local/img/logo.png') }}" class="img-fluid mb-5" style="max-height: 30px;"
                        alt="">

                    <h5 class="user-name mb-1">{{ auth()->user()->name ?? '' }}</h5>
                </div>
            </div>
            <!-- Sidenav Nav-->
            <ul class="sidenav-nav ps-0">
                <li>
                    <a href="{{ route('mobile.profile') }}"><i class="fa fa-user  me-2"></i>My Profile</a>
                </li>
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"><i
                            class="fa fa-toggle-off me-2"></i>Sign Out
                    </a>
                </li>
                <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </ul>
        </div>
    </div>
    <!-- PWA Install Alert -->
    <div class="page-content-wrapper">
        @yield('content')
    </div>


    <!-- Internet Connection Status-->
    <div class="internet-connection-status" id="internetStatus"></div>
    <!-- Footer Nav-->

    <div class="footer-nav-area bg-warning" id="footerNav">
        <div class="suha-footer-nav">
            <ul class="h-100 d-flex align-items-center justify-content-between ps-0 d-flex rtl-flex-d-row-r px-5">
                <li class="{{ $title == 'Home' ? 'active' : '' }}">
                    <a href="{{ route('mobile.index') }}"><i class="fa-solid fa-house"></i><br>Home</a>
                </li>
                <li class="{{ $title == 'Cart' ? 'active' : '' }}">
                    <a href="{{ route('mobile.cart') }}"><i class="fa-solid fa-bag-shopping"></i>
                        @if (!empty($data['count_cart']))
                            <span class="ms-1 badge rounded-pill badge-danger">{{ $data['count_cart'] }}</span>
                        @endif
                        <br>Keranjang
                    </a>
                </li>
                <li class="{{ $title == 'History' ? 'active' : '' }}">
                    <a href="{{ route('mobile.history') }}"><i class="fa-solid fa-receipt"></i><br>History</a>
                </li>

                @if (auth()->check())
                    <li class="{{ $title == 'Log Out' ? 'active' : '' }}">
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                            <i class="fa-solid fa-sign-out"></i><br>Log Out
                        </a>
                        <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                @endif

            </ul>
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
