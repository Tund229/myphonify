<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Myphonify</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('landing_assets/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('landing_assets/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,400,500,700"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('landing_assets/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('landing_assets/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('landing_assets/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('landing_assets/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('landing_assets/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('landing_assets/assets/css/style.css') }}" rel="stylesheet">
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center">
        <div class="container d-flex justify-content-between">

            <div class="logo">
                <a href="route"><img src="{{ asset('landing_assets/assets/img/logo.png') }}" alt=""
                        class="img-fluid"></a>
            </div>


            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Acceuil</a></li>
                    <li><a class="nav-link scrollto" href="#about"> Comment ça marche ? </a></li>
                    <li><a class="nav-link scrollto" href="#why-us">Affiliation</a></li>
                    <li><a class="nav-link scrollto" href="#clients">Services</a></li>
                    @if(Auth::user())
                    <li><a class="nav-link scrollto " href="{{route('home')}}">Tableau de bord </a></li>
                    @else
                    <li><a class="nav-link scrollto " href="{{route('login')}}">Se connecter</a></li>
                    @endif
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>

            <!-- .navbar -->

        </div>
    </header><!-- #header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="clearfix">
        <div class="container" data-aos="fade-up">

            <div class="hero-img" data-aos="zoom-out" data-aos-delay="200">
                <img src="{{ asset('landing_assets/assets/img/hero-img.svg') }}" alt="" class="img-fluid">
            </div>

            <div class="hero-info" data-aos="zoom-in" data-aos-delay="100">
                <h2>
                    Obtenez un 
                    <br>
                    numéro fiable 
                    <br>
                    à partir de 2500 F CFA
                </h2>
                <div>
                    <a href="#" class="btn-services scrollto">Acheter</a>
                </div>
            </div>

        </div>
    </section><!-- End Hero Section -->

    <main id="main">

        <!-- ======= About Section ======= -->
        <section id="about">
            <div class="container" data-aos="fade-up">

                <header class="section-header">
                    <h3>Comment ça marche ?</h3>
                    {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et
                        dolore magna aliqua.</p> --}}
                </header>

                <div class="row about-container">

                    <div class="col-lg-6 content order-lg-1 order-2">
                       
                        <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                            <div class="icon"><i class="bi bi-card-checklist"></i></div>
                            <h4 class="title"><a href="">Eiusmod Tempor</a></h4>
                            <p class="description">Et harum quidem rerum facilis est et expedita distinctio. Nam libero
                                tempore, cum
                                soluta nobis est eligendi</p>
                        </div>

                        <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
                            <div class="icon"><i class="bi bi-brightness-high"></i></div>
                            <h4 class="title"><a href="">Magni Dolores</a></h4>
                            <p class="description">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                                officia deserunt
                                mollit anim id est laborum</p>
                        </div>

                        <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
                            <div class="icon"><i class="bi bi-calendar4-week"></i></div>
                            <h4 class="title"><a href="">Dolor Sitema</a></h4>
                            <p class="description">Minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                                aliquip ex ea
                                commodo consequat tarad limino ata</p>
                        </div>

                    </div>

                    <div class="col-lg-6 background order-lg-2" data-aos="zoom-in">
                        <img src="{{ asset('landing_assets/assets/img/about-img.svg') }}" class="img-fluid"
                            alt="">
                    </div>
                </div>

                <div class="row about-extra">
                    <div class="col-lg-6" data-aos="fade-right">
                        <img src="{{ asset('landing_assets/assets/img/about-extra-2.svg') }}" class="img-fluid"
                            alt="">
                    </div>
                    <div class="col-lg-6 pt-5 pt-lg-0" data-aos="fade-left">
                        <h4>Voluptatem dignissimos provident quasi corporis voluptates sit assumenda.</h4>
                        <p>
                            Ipsum in aspernatur ut possimus sint. Quia omnis est occaecati possimus ea. Quas molestiae
                            perspiciatis
                            occaecati qui rerum. Deleniti quod porro sed quisquam saepe. Numquam mollitia recusandae non
                            ad at et a.
                        </p>
                        <p>
                            Ad vitae recusandae odit possimus. Quaerat cum ipsum corrupti. Odit qui asperiores ea
                            corporis deserunt
                            veritatis quidem expedita perferendis. Qui rerum eligendi ex doloribus quia sit. Porro rerum
                            eum eum.
                        </p>
                    </div>
                </div>

                {{-- <div class="row about-extra">
                    <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left">
                        <img src="{{ asset('landing_assets/assets/img/about-extra-2.svg') }}" class="img-fluid"
                            alt="">
                    </div>

                    <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-right">
                        <h4>Neque saepe temporibus repellat ea ipsum et. Id vel et quia tempora facere reprehenderit.
                        </h4>
                        <p>
                            Delectus alias ut incidunt delectus nam placeat in consequatur. Sed cupiditate quia ea quis.
                            Voluptas nemo
                            qui aut distinctio. Cumque fugit earum est quam officiis numquam. Ducimus corporis autem at
                            blanditiis
                            beatae incidunt sunt.
                        </p>
                        <p>
                            Voluptas saepe natus quidem blanditiis. Non sunt impedit voluptas mollitia beatae. Qui esse
                            molestias.
                            Laudantium libero nisi vitae debitis. Dolorem cupiditate est perferendis iusto.
                        </p>
                        <p>
                            Eum quia in. Magni quas ipsum a. Quis ex voluptatem inventore sint quia modi. Numquam est
                            aut fuga
                            mollitia exercitationem nam accusantium provident quia.
                        </p>
                    </div>

                </div> --}}

            </div>
        </section><!-- End About Section -->

   
        <!-- ======= Why Us Section ======= -->
        <section id="why-us">
            <div class="container" data-aos="fade-up">
                <header class="section-header">
                    <h3>Why choose us?</h3>
                    <p>Laudem latine persequeris id sed, ex fabulas delectus quo. No vel partiendo abhorreant
                        vituperatoribus.</p>
                </header>

                <div class="row row-eq-height justify-content-center">

                    <div class="col-lg-4 mb-4">
                        <div class="card" data-aos="zoom-in" data-aos-delay="100">
                            <i class="bi bi-calendar4-week"></i>
                            <div class="card-body">
                                <h5 class="card-title">Corporis dolorem</h5>
                                <p class="card-text">Deleniti optio et nisi dolorem debitis. Aliquam nobis est
                                    temporibus sunt ab
                                    inventore officiis aut voluptatibus.</p>
                                <a href="#" class="readmore">Read more </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 mb-4">
                        <div class="card" data-aos="zoom-in" data-aos-delay="200">
                            <i class="bi bi-camera-reels"></i>
                            <div class="card-body">
                                <h5 class="card-title">Voluptates dolores</h5>
                                <p class="card-text">Voluptates nihil et quis omnis et eaque omnis sint aut. Ducimus
                                    dolorum aspernatur.
                                </p>
                                <a href="#" class="readmore">Read more </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 mb-4">
                        <div class="card" data-aos="zoom-in" data-aos-delay="300">
                            <i class="bi bi-chat-square-text"></i>
                            <div class="card-body">
                                <h5 class="card-title">Eum ut aspernatur</h5>
                                <p class="card-text">Autem quod nesciunt eos ea aut amet laboriosam ab. Eos quis porro
                                    in non nemo ex.
                                </p>
                                <a href="#" class="readmore">Read more </a>
                            </div>
                        </div>
                    </div>

                </div>

            
            </div>
        </section><!-- End Why Us Section -->

        <!-- ======= Clients Section ======= -->
        <section id="clients" class="section-bg">

            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h3>Services Disponibles</h3>
                    <p>Voici une liste des services que nous offrons
                    </p>
                </div>

                <div class="row g-0 clients-wrap clearfix" data-aos="zoom-in" data-aos-delay="100">

                    <div class="col-lg-3 col-md-4 col-xs-6">
                        <div class="client-logo">
                            <img src="{{ asset('landing_assets/assets/img/clients/client-1.png') }}"
                                class="img-fluid" alt="">
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-xs-6">
                        <div class="client-logo">
                            <img src="{{ asset('landing_assets/assets/img/clients/client-2.png') }}"
                                class="img-fluid" alt="">
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-xs-6">
                        <div class="client-logo">
                            <img src="{{ asset('landing_assets/assets/img/clients/client-3.png') }}"
                                class="img-fluid" alt="">
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-xs-6">
                        <div class="client-logo">
                            <img src="{{ asset('landing_assets/assets/img/clients/client-4.png') }}"
                                class="img-fluid" alt="">
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-xs-6">
                        <div class="client-logo">
                            <img src="{{ asset('landing_assets/assets/img/clients/client-5.png') }}"
                                class="img-fluid" alt="">
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-xs-6">
                        <div class="client-logo">
                            <img src="{{ asset('landing_assets/assets/img/clients/client-6.png') }}"
                                class="img-fluid" alt="">
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-xs-6">
                        <div class="client-logo">
                            <img src="{{ asset('landing_assets/assets/img/clients/client-7.png') }}"
                                class="img-fluid" alt="">
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-xs-6">
                        <div class="client-logo">
                            <img src="{{ asset('landing_assets/assets/img/clients/client-8.png') }}"
                                class="img-fluid" alt="">
                        </div>
                    </div>

                </div>

            </div>

        </section><!-- End Clients Section -->



    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong>Myohonify</strong>. Tous droits réservés
            </div>
            {{-- <div class="credits">

                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div> --}}
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('landing_assets/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('landing_assets/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('landing_assets/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('landing_assets/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('landing_assets/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('landing_assets/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('landing_assets/assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('landing_assets/assets/js/main.js') }}"></script>

</body>

</html>
