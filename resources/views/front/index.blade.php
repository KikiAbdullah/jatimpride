@extends('front.layout')

@section('content')
    <style>
        .overlay-video {
            display: none;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
            opacity: 0;
            -ms-transition: opacity 600ms ease-in;
            transition: opacity 600ms ease-in;
            -ms-transition: opacity .6s;
            transition: opacity .6s;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background: rgba(0, 0, 0, .7);
            z-index: 999999;
        }

        .o1 {
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
            opacity: 1;
            -ms-transition: opacity 600ms ease-out;
            transition: opacity 600ms ease-out;
            -ms-transition: opacity .6s;
            transition: opacity .6s;
        }

        .videoWrapperExt {
            position: relative;
            top: 50%;
            left: 50%;
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            max-width: 982px;
            padding: 0 20px;
        }

        .videoWrapper {
            position: relative;
            padding-bottom: 56.25%;
            /* 16:9 */
            height: 0;
        }

        .videoWrapper iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .close {
            background-image: url(http://djit.ac/assets/images/news/mark.png);
            position: absolute;
            top: -50px;
            right: 0px;
            cursor: pointer;
            z-index: 9999;
            height: 40px;
            width: 40px;
            background-size: 40px;

            @media (max-width: 767px) and (orientation: landscape) {
                display: none;
            }
        }
    </style>
    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">
        <img src="{{ asset('app_local/img/slide/1.png') }}" class="hero-img" alt="" data-aos="fade-in" />

        <div class="container">
            <div class="row justify-content-center text-center" data-aos="fade-up" data-aos-delay="100">
                <div class="col-xl-6 col-lg-8">
                    <img src="{{ asset('app_local/img/road-to.png') }}" class="img-fluid" st alt="" />

                    <div class="row gy-4 justify-content-center" data-aos="fade-up" data-aos-delay="200">
                        <div class="col-3" data-aos="fade-up" data-aos-delay="300">
                            <div class="icon-box">
                                <h1><a href="#!" id="days">0</a></h1>

                                <h3><a href="#!">Hari</a></h3>

                            </div>
                        </div>
                        <div class="col-3" data-aos="fade-up" data-aos-delay="400">
                            <div class="icon-box">
                                <h1><a href="#!" id="hours">0</a></h1>
                                <h3><a href="#!">Jam</a></h3>
                            </div>
                        </div>
                        <div class="col-3" data-aos="fade-up" data-aos-delay="500">
                            <div class="icon-box">
                                <h1><a href="#!" id="minutes">0</a></h1>

                                <h3><a href="#!">Menit</a></h3>
                            </div>
                        </div>
                        <div class="col-3" data-aos="fade-up" data-aos-delay="600">
                            <div class="icon-box">
                                <h1><a href="#!" id="seconds">0</a></h1>

                                <h3><a href="#!">Detik</a></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 text-center">
                    <br>
                    <a class="btn-location text-white" href="https://maps.app.goo.gl/ThygBK4LbCH5sobU9"
                        target="_blank">Lihat Lokasi Acara</a>
                </div>
            </div>


        </div>
    </section>
    <!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">
                <div class="col-lg-3">
                    <!-- Section Title -->
                    <div class="container section-title" data-aos="fade-up">
                        <h2>About</h2>
                        <p>About Us</p>
                    </div>
                    <img src="{{ asset('app_local/img/mas-fadh.jpg') }}" class="img-fluid" alt="" />
                </div>
                <div class="col-lg-9 content">

                    <!-- End Section Title -->
                    <p style="text-align: justify;">
                        Assalamualikum wr.wb.<br>
                        Salam sejahtera untuk kita semua,
                        <br>
                        <br>Salam otomotif !
                        <br>Salam jatim pride ! All In Untuk Semesta 🔥

                        <br>Puji syukur kehadirat Allah SWT atas segala nikmat dan karunia-Nya sehingga kita semua masih
                        diberikan kesehatan jasmani maupun rohani dan tetap menjalin silaturahmi dalam satu hobi di dunia
                        otomotif .
                        <br>
                        <br>Perkenalkan saya Mas Fadh Tri Wahyudo S.E. Sering di sapa mas fadh , selaku dari CEO / Leader
                        Jatim
                        Pride
                        <br>
                        <br>JATIM PRIDE adalah sebuah kegiatan apresiasi dalam bidang otomotif motor di segala merk motor
                        yang
                        ada. Banyak nya antusiasme pada akhir akhir ini pemuda pemuda yang menggandrungi hobi dalam bidang
                        otomotif melalui media sosial yang berkembang pada jaman saat ini. Kami “JATI JAYA ENTERTAINMENT”
                        mengadakan acara yang bertujuan untuk menyambung tali silaturahmi dan menyambung seduluran diantara
                        banyaknya jenis jenis motor yang ada. Kegiatan ini akan mengundang seluruh pemuda yang memiliki hobi
                        yang sama di sekitar Provinsi Jawa Timur. Dari CB, Herex, Matic, Supermoto, Moge, 2 tak dan lain
                        sebagainya akan turut hadir, karena sebuah perbedaan itu akanme nimbulkan suatu Persaudaraan. Acara
                        ini memiliki konsep unik dan menarik, serta diikuti dengan konten acara yang berkualitas dengan
                        mengusung tema “JATIM PRIDE” dengan maksud bahwa kami adalah Kerbanggaan Jawa Timur dengan banyaknya
                        jenis motor yang menarik, elegan bagi berbagai macam kalangan serta selalu menumbuhkan persatuan dan
                        persaudaraan terhadap sesama club dengan jenis / merk yang berbeda.
                        <br>
                        <br>Alhamdulillaah Jatim pride sudah berada di Volume 4 , ini adalah sebuah semangat luar biasa
                        pemuda
                        dibidang otomotif untuk tetap melestarikan di Jawa Timur
                        Saya mengucapkan terima kasih sebanyak banyaknya kepada seluruh Elemen yang selalu membantu setiap
                        giat Jatim Pride mulai volume 1-4 ini .
                        <br>
                        <br>Semoga kita semua senantiasa di beri kesehatan dan kemudahan dalam segala hal langkah kebaikan
                        kita
                        untuk manfaat di masyarakat !
                        <br>
                        <br>Ingat tetap jangan arogan di Jalan raya , keep safety dan tunjukkan bahwa kita semua sangat
                        bermanfaat untuk masyarakat luas di Jawa Timur !
                        <br>
                        <br>Salam Jatim Pride ! All in untuk Semesta !
                    </p>

                    <a class="btn-location text-white" href="#">Download Proposal PDF</a>
                </div>
            </div>
        </div>
    </section>
    <!-- /About Section -->

    <!-- merchandise Section -->
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
                        <img src="{{ asset('app_local/img/tshirt-placeholder.jpg') }}" class="img-fluid" alt="">

                    </div>
                    <!-- End Service Item -->

                    <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <img src="{{ asset('app_local/img/tshirt-placeholder.jpg') }}" class="img-fluid" alt="">
                    </div>
                    <!-- End Service Item -->

                    <div class="col-lg-12 text-center">
                        <p class="mt-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint nisi
                            aliquid eligendi
                            dignissimos
                            voluptatem soluta, ea quis amet ipsum odit aliquam nostrum earum iusto, optio maxime
                            mollitia
                            vel, repellat accusantium!</p>

                        <a class="btn-location text-white" href="{{ route('front.merchandise') }}">Beli Sekarang</a>

                    </div>
                </div>



            </div>
        </div>
    </section>
    <!-- /merchandise Section -->

    <!-- activity Section -->
    <section id="activity" class="portfolio section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Activity</h2>
            <p>Our Activity Concern</p>
        </div>
        <!-- End Section Title -->

        <div class="container">
            <div class="row gy-4" data-aos="fade-up" data-aos-delay="200">
                <div class="col-lg-6 col-md-6">
                    <figure class="img-hover-text">
                        <img src="{{ asset('app_local/img/slide/1.jpg') }}" class="w-100" alt="KONTES OTOMOTIF" />
                        <figcaption>
                            <h1>KONTES OTOMOTIF</h1>
                        </figcaption>
                        <a href="#"></a>
                    </figure>
                </div>
                <!-- End Portfolio Item -->

                <div class="col-lg-6 col-md-6">
                    <figure class="img-hover-text">
                        <img src="{{ asset('app_local/img/slide/2.jpg') }}" class="w-100" alt="SUNDAY MORNING RIDE" />
                        <figcaption>
                            <h1>SUNDAY MORNING RIDE</h1>
                        </figcaption>
                        <a href="#"></a>
                    </figure>
                </div>
                <!-- End Portfolio Item -->

                <div class="col-lg-6 col-md-6">
                    <figure class="img-hover-text">
                        <img src="{{ asset('app_local/img/slide/3.jpg') }}" class="w-100" alt="BAZZAR UMKM" />
                        <figcaption>
                            <h1>BAZZAR UMKM</h1>
                        </figcaption>
                        <a href="#"></a>
                    </figure>
                </div>
                <!-- End Portfolio Item -->

                <div class="col-lg-6 col-md-6">
                    <figure class="img-hover-text">
                        <img src="{{ asset('app_local/img/slide/4.jpg') }}" class="w-100" alt="KONSER MUSIK" />
                        <figcaption>
                            <h1>KONSER MUSIK</h1>
                        </figcaption>
                        <a href="#"></a>
                    </figure>
                </div>
                <!-- End Portfolio Item -->
            </div>
            <!-- End Portfolio Container -->
        </div>
    </section>
    <!-- /activity Section -->

    <!-- event Section -->
    <section id="event" class="team section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Event</h2>
            <p>Our Succeed Event</p>
        </div>
        <!-- End Section Title -->

        <div class="container">
            <div class="row justify-content-center gy-4">

                <div class="col-lg-3 col-md-3 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                    <figure class="img-hover-text">
                        <img src="{{ asset('app_local/img/flyer/jp_v1.jpg') }}" alt="sample89" />
                        <figcaption>
                            <h1>JATIM PRIDE VOL.1</h1>
                        </figcaption>
                        <a href="https://www.youtube.com/embed/5KvTCuj8RVI?rel=0&amp;showinfo=0&amp;autoplay=1" class="overlay-yt"></a>
                    </figure>
                </div>
                <!-- End Team Member -->

                <div class="col-lg-3 col-md-3 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                    <figure class="img-hover-text">
                        <img src="{{ asset('app_local/img/flyer/jp_v2.jpg') }}" alt="sample89" />
                        <figcaption>
                            <h1>JATIM PRIDE VOL.2</h1>
                        </figcaption>
                        <a href="https://www.youtube.com/embed/6LPPfqCpTr4?rel=0&amp;showinfo=0&amp;autoplay=1" class="overlay-yt"></a>
                    </figure>
                </div>
                <!-- End Team Member -->

                <div class="col-lg-3 col-md-3 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                    <figure class="img-hover-text">
                        <img src="{{ asset('app_local/img/flyer/jp_v3.jpg') }}" alt="sample89" />
                        <figcaption>
                            <h1>JATIM PRIDE VOL.3</h1>
                        </figcaption>
                        <a href="https://www.youtube.com/embed/QCLJQ8ZcDJE?rel=0&amp;showinfo=0&amp;autoplay=1" class="overlay-yt"></a>
                    </figure>
                </div>
                <!-- End Team Member -->
            </div>
        </div>
    </section>
    <!-- /event Section -->


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
                <div class="swiper-wrapper align-items-center tex">
                    <div class="swiper-slide">
                        <img src="{{ asset('app_local/img/sponsor/jne.png') }}" class="img-fluid" alt="" />
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('app_local/img/sponsor/kilap.png') }}" class="img-fluid" alt="" />
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('app_local/img/sponsor/surya.png') }}" class="img-fluid" alt="" />
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
    <!-- /Clients Section -->

    <div class="overlay-video">

        <div class="videoWrapperExt">
            <div class="videoWrapper">
                <div class="close"></div>
                <iframe id="player" width="853" height="480" src="" frameborder="0"
                    allowfullscreen></iframe>
            </div>
        </div>
    </div>
@endsection


@section('customjs')
    <script>
        // Set the date we're counting down to
        var countDownDate = new Date("Sep 29, 2024 07:00:00").getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result in the element with id="demo"
            document.getElementById("days").innerHTML = days;
            document.getElementById("hours").innerHTML = hours;
            document.getElementById("minutes").innerHTML = minutes;
            document.getElementById("seconds").innerHTML = seconds;

            // If the count down is finished, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("days").innerHTML = '0';
                document.getElementById("hours").innerHTML = '0';
                document.getElementById("minutes").innerHTML = '0';
                document.getElementById("seconds").innerHTML = '0';
            }
        }, 1000);



        $(".overlay-yt").unbind("click").bind("click", function(e) {
            e.preventDefault();
            var src = $(this).attr("href");
            $(".overlay-video").show();
            setTimeout(function() {
                $(".overlay-video").addClass("o1");
                $("#player").attr("src", src);
            }, 100);
        });


        $(".overlay-video").click(function(event) {
            if (!$(event.target).closest(".videoWrapperExt").length) {
                var PlayingVideoSrc = $("#player").attr("src").replace("&autoplay=1", "");
                $("#player").attr("src", PlayingVideoSrc);
                $(".overlay-video").removeClass("o1");
                setTimeout(function() {
                    $(".overlay-video").hide();
                }, 600);
            }
        });

        // video overlayer: close it via the X icon

        $(".close").click(function(event) {
            var PlayingVideoSrc = $("#player").attr("src").replace("&autoplay=1", "");
            $("#player").attr("src", PlayingVideoSrc);
            $(".overlay-video").removeClass("o1");
            setTimeout(function() {
                $(".overlay-video").hide();
            }, 600);

        });
    </script>
@endsection
