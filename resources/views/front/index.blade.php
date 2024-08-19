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

    <!-- =======================================================
  * Template Name: Gp
  * Template URL: https://bootstrapmade.com/gp-free-multipurpose-html-bootstrap-template/
  * Updated: Aug 15 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page dark-background">
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
            <a href="{{ route('front.index') }}" class="logo d-flex align-items-center me-auto me-lg-0">
                <img src="{{ asset('app_local/img/logo.png') }}" alt="">
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#about">About Us</a></li>
                    <li><a href="#contact">Contact Us</a></li>
                    <li><a href="#merchandise">Merchandise</a></li>
                    <li><a href="#event">Our Event</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
            <a class="btn-getstarted" href="{{ route('mobile.index') }}">Registrasi</a>
        </div>
    </header>

    <main class="main">
        <!-- Hero Section -->
        <section id="hero" class="hero section dark-background">
            <img src="{{ asset('app_local/img/slide/1.png') }}" class="hero-img" alt="" data-aos="fade-in" />

            <div class="container">
                <div class="row justify-content-center text-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-xl-6 col-lg-8">
                        <img src="{{ asset('app_local/img/jp4.png') }}" class="img-fluid" st alt="" />

                        <div class="row gy-4 justify-content-center" data-aos="fade-up" data-aos-delay="200">
                            <div class="col-3" data-aos="fade-up" data-aos-delay="300">
                                <div class="icon-box">
                                    <h1><a href="#!">10</a></h1>

                                    <h3><a href="#!">Days</a></h3>

                                </div>
                            </div>
                            <div class="col-3" data-aos="fade-up" data-aos-delay="400">
                                <div class="icon-box">
                                    <h1><a href="#!">10</a></h1>
                                    <h3><a href="#!">Hours</a></h3>
                                </div>
                            </div>
                            <div class="col-3" data-aos="fade-up" data-aos-delay="500">
                                <div class="icon-box">
                                    <h1><a href="#!">10</a></h1>

                                    <h3><a href="#!">Minutes</a></h3>
                                </div>
                            </div>
                            <div class="col-3" data-aos="fade-up" data-aos-delay="600">
                                <div class="icon-box">
                                    <h1><a href="#!">10</a></h1>

                                    <h3><a href="#!">Seconds</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 text-center">
                        <a class="btn-location text-white" href="#">Lihat Lokasi Acara</a>
                    </div>
                </div>


            </div>
        </section>
        <!-- /Hero Section -->

        <!-- About Section -->
        <section id="about" class="about section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row gy-4">
                    <div class="col-lg-6 order-2 order-lg-2">
                        <img src="{{ asset('front-asset/img/about.jpg') }}" class="img-fluid" alt="" />
                    </div>
                    <div class="col-lg-6 order-1 order-lg-1 content">
                        <!-- Section Title -->
                        <div class="container section-title" data-aos="fade-up">
                            <h2>About</h2>
                            <p>About Us</p>
                        </div>
                        <!-- End Section Title -->
                        <p>
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iure quis sunt, blanditiis iusto
                            libero rem, dolore deserunt pariatur odio delectus voluptatibus, labore dignissimos unde eum
                            at quaerat culpa non aperiam.
                        </p>

                        <a class="btn-location text-white" href="#">Download Proposal PDF</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- /About Section -->

        <!-- Services Section -->
        <section id="merchandise" class="services section">
            <!-- Section Title -->
            <div class="container section-title text-center" data-aos="fade-up">
                <h2>Merchandise</h2>
                <p>Official Merchandise</p>
            </div>
            <!-- End Section Title -->

            <div class="container">
                <div class="row gy-4 justify-content-center">
                    <div class="col-lg-8 row">
                        <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="100">
                            <img src="{{ asset('app_local/img/tshirt-placeholder.jpg') }}" class="img-fluid"
                                alt="">

                        </div>
                        <!-- End Service Item -->

                        <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="200">
                            <img src="{{ asset('app_local/img/tshirt-placeholder.jpg') }}" class="img-fluid"
                                alt="">
                        </div>
                        <!-- End Service Item -->

                        <div class="col-lg-12 text-center">
                            <p class="mt-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint nisi
                                aliquid eligendi
                                dignissimos
                                voluptatem soluta, ea quis amet ipsum odit aliquam nostrum earum iusto, optio maxime
                                mollitia
                                vel, repellat accusantium!</p>

                            <a class="btn-location text-white" href="#">Beli Sekarang</a>

                        </div>
                    </div>



                </div>
            </div>
        </section>
        <!-- /Services Section -->


        <!-- Portfolio Section -->
        <section id="activity" class="portfolio section">
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Activity</h2>
                <p>Our Activity Concern</p>
            </div>
            <!-- End Section Title -->

            <div class="container">
                <div class="isotope-layout" data-default-filter="*" data-layout="masonry"
                    data-sort="original-order">
                    <!-- End Portfolio Filters -->

                    <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
                        <div class="col-lg-6 col-md-6 portfolio-item isotope-item filter-app">
                            <img src="{{ asset('app_local/img/slide/1.jpg') }}" class="img-fluid" alt="" />
                            <div class="portfolio-info">
                                <h4>KONTES OTOMOTIF</h4>
                                <a href="{{ asset('app_local/img/slide/1.jpg') }}" title="KONTES OTOMOTIF"
                                    data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i
                                        class="bi bi-zoom-in"></i></a>
                            </div>
                        </div>
                        <!-- End Portfolio Item -->

                        <div class="col-lg-6 col-md-6 portfolio-item isotope-item filter-app">
                            <img src="{{ asset('app_local/img/slide/2.jpg') }}" class="img-fluid" alt="" />
                            <div class="portfolio-info">
                                <h4>SUNDAY MORNING RIDE</h4>
                                <a href="{{ asset('app_local/img/slide/2.jpg') }}" title="SUNDAY MORNING RIDE"
                                    data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i
                                        class="bi bi-zoom-in"></i></a>
                            </div>
                        </div>
                        <!-- End Portfolio Item -->

                        <div class="col-lg-6 col-md-6 portfolio-item isotope-item filter-app">
                            <img src="{{ asset('app_local/img/slide/3.jpg') }}" class="img-fluid" alt="" />
                            <div class="portfolio-info">
                                <h4>BAZZAR UMKM</h4>
                                <a href="{{ asset('app_local/img/slide/3.jpg') }}" title="BAZZAR UMKM"
                                    data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i
                                        class="bi bi-zoom-in"></i></a>
                            </div>
                        </div>
                        <!-- End Portfolio Item -->

                        <div class="col-lg-6 col-md-6 portfolio-item isotope-item filter-app">
                            <img src="{{ asset('app_local/img/slide/4.jpg') }}" class="img-fluid" alt="" />
                            <div class="portfolio-info">
                                <h4>KONSER MUSIK</h4>
                                <a href="{{ asset('app_local/img/slide/4.jpg') }}" title="KONSER MUSIK"
                                    data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i
                                        class="bi bi-zoom-in"></i></a>
                            </div>
                        </div>
                        <!-- End Portfolio Item -->
                    </div>
                    <!-- End Portfolio Container -->
                </div>
            </div>
        </section>
        <!-- /Portfolio Section -->


        <!-- Team Section -->
        <section id="event" class="team section">
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Event</h2>
                <p>Our Succeed Event</p>
            </div>
            <!-- End Section Title -->

            <div class="container">
                <div class="row gy-4">

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up"
                        data-aos-delay="200">
                        <div class="team-member">
                            <div class="member-img">
                                <img src="{{ asset('app_local/img/artwork.png') }}" class="img-fluid"
                                    alt="" />
                                <div class="social">
                                    <h4>JATIM PRIDE VOL. 1</h4>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>See More</h4>
                            </div>
                        </div>
                    </div>
                    <!-- End Team Member -->

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up"
                        data-aos-delay="200">
                        <div class="team-member">
                            <div class="member-img">
                                <img src="{{ asset('app_local/img/artwork.png') }}" class="img-fluid"
                                    alt="" />
                                <div class="social">
                                    <h4>JATIM PRIDE VOL. 2</h4>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>See More</h4>
                            </div>
                        </div>
                    </div>
                    <!-- End Team Member -->

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up"
                        data-aos-delay="200">
                        <div class="team-member">
                            <div class="member-img">
                                <img src="{{ asset('app_local/img/artwork.png') }}" class="img-fluid"
                                    alt="" />
                                <div class="social">
                                    <h4>JATIM PRIDE VOL. 3</h4>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>See More</h4>
                            </div>
                        </div>
                    </div>
                    <!-- End Team Member -->
                </div>
            </div>
        </section>
        <!-- /Team Section -->


        <!-- Clients Section -->
        <section id="clients" class="clients section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="swiper init-swiper">
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
                },
                "breakpoints": {
                  "320": {
                    "slidesPerView": 2,
                    "spaceBetween": 40
                  },
                  "480": {
                    "slidesPerView": 3,
                    "spaceBetween": 60
                  },
                  "640": {
                    "slidesPerView": 4,
                    "spaceBetween": 80
                  },
                  "992": {
                    "slidesPerView": 6,
                    "spaceBetween": 120
                  }
                }
              }
            </script>
                    <div class="swiper-wrapper align-items-center">
                        <div class="swiper-slide">
                            <img src="{{ asset('app_local/img/sponsor/jne.png') }}" class="img-fluid"
                                alt="" />
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ asset('app_local/img/sponsor/kilap.png') }}" class="img-fluid"
                                alt="" />
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ asset('app_local/img/sponsor/surya.png') }}" class="img-fluid"
                                alt="" />
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>
        <!-- /Clients Section -->


    </main>

    <footer id="footer" class="footer dark-background">
        <div class="footer-top">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-4 col-md-6 footer-about">
                        <a href="{{ route('front.index') }}" class="logo d-flex align-items-center">
                            <img src="{{ asset('app_local/img/logo.png') }}" alt="">
                        </a>
                        <div class="footer-contact pt-3">
                            <p>A108 Adam Street</p>
                            <p>New York, NY 535022</p>
                            <p class="mt-3">
                                <strong>Phone:</strong> <span>+1 5589 55488 55</span>
                            </p>
                            <p><strong>Email:</strong> <span>info@example.com</span></p>
                        </div>
                        <div class="social-links d-flex mt-4">
                            <a href="#!"><i class="bi bi-twitter-x"></i></a>
                            <a href="#!"><i class="bi bi-facebook"></i></a>
                            <a href="#!"><i class="bi bi-instagram"></i></a>
                            <a href="#!"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-3 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li>
                                <i class="bi bi-chevron-right"></i> <a href="#"> About us</a>
                            </li>
                            <li>
                                <i class="bi bi-chevron-right"></i> <a href="#"> Contact</a>
                            </li>
                            <li>
                                <i class="bi bi-chevron-right"></i> <a href="#"> Merchandise</a>
                            </li>
                            <li>
                                <i class="bi bi-chevron-right"></i> <a href="#"> Our Event</a>
                            </li>
                        </ul>
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
    <script src="{{ asset('front-asset/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('front-asset/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('front-asset/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('front-asset/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('front-asset/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('front-asset/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('front-asset/vendor/purecounter/purecounter_vanilla.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('front-asset/js/main.js') }}"></script>
</body>

</html>
