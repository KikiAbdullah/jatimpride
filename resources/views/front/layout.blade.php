<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>{{ env('APP_NAME') }}</title>
    <meta name="description"
        content="JATIM PRIDE merupakan sebuah kegiatan apresiasi dalam bidang otomotif terkhusus sepeda motor, yang didasarkan oleh banyaknya antusiasme terhadap sepeda motor akhir-akhir ini, sehingga kami “JATI JAYA ENTERTAINMENT” menginisiasi acara yang bertujuan untuk menyambung tali silaturahmi dan seduluran diantara banyaknya komunitas sepeda motor dengan berbagai jenis style yang ada, untuk itu kami mengundang seluruh pemuda yang memiliki hobi yang sama dalam bidang otomotif di sekitar Provinsi Jawa Timur untuk dapat hadir." />
    <meta name="keywords"
        content="Jatim Pride, event otomotif, sepeda motor, komunitas motor, Jawa Timur, silaturahmi bikers, Jatim Pride Vol 4, Jati Jaya Entertainment, acara motor Jawa Timur, persaudaraan bikers, otomotif Jawa Timur, pertemuan komunitas motor, event bikers, gaya motor custom, hobi otomotif, acara motor regional" />


    <!-- Open Graph Meta Tags (Untuk Social Media) -->
    <meta property="og:title" content="JATIM PRIDE">
    <meta property="og:description"
        content="JATIM PRIDE merupakan sebuah kegiatan apresiasi dalam bidang otomotif terkhusus sepeda motor, yang didasarkan oleh banyaknya antusiasme terhadap sepeda motor akhir-akhir ini, sehingga kami “JATI JAYA ENTERTAINMENT” menginisiasi acara yang bertujuan untuk menyambung tali silaturahmi dan seduluran diantara banyaknya komunitas sepeda motor dengan berbagai jenis style yang ada, untuk itu kami mengundang seluruh pemuda yang memiliki hobi yang sama dalam bidang otomotif di sekitar Provinsi Jawa Timur untuk dapat hadir.">
    <meta property="og:image" content="{{ setting('logo_url') }}">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:type" content="website">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:title" content="JATIM PRIDE">
    <meta name="twitter:description"
        content="JATIM PRIDE merupakan sebuah kegiatan apresiasi dalam bidang otomotif terkhusus sepeda motor, yang didasarkan oleh banyaknya antusiasme terhadap sepeda motor akhir-akhir ini, sehingga kami “JATI JAYA ENTERTAINMENT” menginisiasi acara yang bertujuan untuk menyambung tali silaturahmi dan seduluran diantara banyaknya komunitas sepeda motor dengan berbagai jenis style yang ada, untuk itu kami mengundang seluruh pemuda yang memiliki hobi yang sama dalam bidang otomotif di sekitar Provinsi Jawa Timur untuk dapat hadir.">
    <meta name="twitter:image" content="{{ setting('logo_url') }}">


    <!-- Favicons -->
    <link href="{{ setting('icon_url') ?? '' }}" rel="icon" />
    <link href="{{ setting('icon_url') ?? '' }}" rel="apple-touch-icon" />

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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
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

<body class="index-page dark-background">
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
            <a href="{{ route('front.index') }}" class="logo d-flex align-items-center me-auto me-lg-0">
                <img src="{{ setting('logo_url') }}" alt="">
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="{{ route('front.index') }}#about">About Us</a></li>
                    <li><a href="https://wa.me/6282245283892" target="_blank">Contact Us</a></li>
                    <li><a class="{{ @$title == 'mechandise' ? 'active' : '' }}"
                            href="{{ route('front.index') }}#merchandise">Merchandise</a></li>
                    <li><a href="{{ route('front.index') }}#event">Our Event</a></li>
                    <li><a class="{{ @$title == 'crew' ? 'active' : '' }}" href="{{ route('front.crew') }}">Our
                            Crew</a></li>
                    <li><a href="https://www.yesplis.com/event/jatim-pride-vol.-4" target="_blank">Ticket</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
            @if (Auth::check())
                <a class="btn-getstarted ms-" href="{{ route('front.profile') }}">Profil</a>
            @else
                <a class="btn-getstarted" href="{{ route('login') }}">Log In</a>
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
                        <div class="footer-contact pt-3">
                            <h2>{{ setting('contact_name') ?? '' }}</h2>
                            <p>{{ setting('contact_alamat') ?? '' }}</p>
                            <p class="mt-3">
                                <strong>Whatsapp:</strong> <span>{{ setting('contact_whatsapp') ?? '' }}</span>
                            </p>
                            <p><strong>Email:</strong> <span><a href="mailto:{{ setting('contact_email') ?? '' }}"
                                        target="_blank"
                                        rel="noopener noreferrer">{{ setting('contact_email') ?? '' }}</a></span></p>
                        </div>

                    </div>
                    <div class="col-lg-6">
                        <div class="footer-contact pt-3">
                            <h2>Follow Us on Social Media</h2>
                        </div>
                        <div class="social-links d-flex mt-4">
                            <a class="fs-2" href="{{ setting('contact_instagram') ?? '' }}" target="_blank"><i
                                    class="bi bi-instagram"></i></a>
                            <a class="fs-2" href="{{ setting('contact_tiktok') ?? '' }}" target="_blank"><i
                                    class="bi bi-tiktok"></i></a>
                            <a class="fs-2" href="{{ setting('contact_youtube') ?? '' }}" target="_blank"><i
                                    class="bi bi-youtube"></i></a>
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

    <script src="{{ asset('front-asset/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('front-asset/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('front-asset/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('front-asset/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('front-asset/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('front-asset/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('front-asset/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    @yield('customjs')

    <!-- Main JS File -->
    <script src="{{ asset('front-asset/js/main.js') }}"></script>


</body>

</html>
