<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>{{ env('APP_NAME') }}</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />

    <!-- Favicons -->
    <link href="{{ asset('app_local/img/favicon.png') }}" rel="icon" />
    <link href="{{ asset('app_local/img/favicon.png') }}" rel="apple-touch-icon" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />

    <!-- Vendor CSS Files -->
    <link href="{{ asset('front-asset/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('front-asset/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('front-asset/vendor/aos/aos.css') }}" rel="stylesheet" />
    <link href="{{ asset('front-asset/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('front-asset/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet" />

    <!-- Main CSS File -->
    <link href="{{ asset('front-asset/css/main.css') }}" rel="stylesheet" />
</head>

<body class="index-page dark-background">
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
            <a href="{{ route('front.index') }}" class="logo d-flex align-items-center me-auto me-lg-0">
                <img src="{{ asset('app_local/img/logo.png') }}" alt="">
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="{{ route('front.index') }}#about">About Us</a></li>
                    <li><a href="{{ route('front.index') }}#contact">Contact Us</a></li>
                    <li><a href="{{ route('front.index') }}#merchandise">Merchandise</a></li>
                    <li><a href="{{ route('front.index') }}#event">Our Event</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
            @if ($is_login)
                <a class="btn-getstarted ms-" href="{{ route('mobile.profile') }}">Profile</a>
            @else
                <a class="btn-getstarted" href="{{ route('mobile.index') }}">Login</a>
            @endif
        </div>
    </header>

    <main class="main">
        @yield('content')
    </main>

    <footer id="footer" class="footer dark-background">
        <div class="footer-top">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-6 col-md-6 footer-about">
                        <a href="{{ route('front.index') }}" class="logo d-flex align-items-center">
                            <img src="{{ asset('app_local/img/logo.png') }}" alt="">
                        </a>
                        <div class="footer-contact pt-3">
                            <p>Jati Jaya Garage</p>
                            <p>Jl. Rambutan, Wringinanom, Jogosari,<br>Kec. Pandaan, Pasuruan, Jawa Timur 67156</p>
                            <p class="mt-3">
                                <strong>Whatsapp:</strong> <span>0822-4528-3892</span>
                            </p>
                            <p><strong>Email:</strong> <span>officialjatimpride@gmail.com</span></p>
                        </div>
                        <div class="social-links d-flex mt-4">
                            <a href="#!"><i class="bi bi-instagram"></i></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="copyright">
            <div class="container text-center">
                <p>
                    © <span>Copyright</span> <strong class="px-1 sitename">JATIMPRIDE</strong>
                    <span>All Rights Reserved</span>
                </p>
                <div class="credits">
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

    <!-- Vendor JS Files -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('front-asset/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('front-asset/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('front-asset/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('front-asset/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('front-asset/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('front-asset/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('front-asset/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('front-asset/vendor/purecounter/purecounter_vanilla.js') }}"></script>

    @yield('customjs')

    <!-- Main JS File -->
    <script src="{{ asset('front-asset/js/main.js') }}"></script>


</body>

</html>
