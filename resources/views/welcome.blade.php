<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Myphonify</title>
    <meta name="description"
        content="Achetez des numéros virtuels pour votre entreprise et offrez à vos clients un moyen simple de vous contacter. Découvrez notre large sélection de numéros disponibles dans différentes régions du monde.">
    <meta name="keywords"
        content="numéros virtuels, numéros de téléphone, ventes, entreprise, communication, contacts, clients">

    <!-- Balises Open Graph -->
    <meta property="og:title" content="Vente de Numéros Virtuels">
    <meta property="og:description"
        content="Achetez des numéros virtuels pour votre entreprise et offrez à vos clients un moyen simple de vous contacter. Découvrez notre large sélection de numéros disponibles dans différentes régions du monde.">
    <meta property="og:image" content="https://myphonify.com/landing_assets/assets/img/logo.png">
    <meta property="og:url" content="https://myphonify.com">

    <!-- Balises Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Vente de Numéros Virtuels">
    <meta name="twitter:description"
        content="Achetez des numéros virtuels pour votre entreprise et offrez à vos clients un moyen simple de vous contacter. Découvrez notre large sélection de numéros disponibles dans différentes régions du monde.">
    <meta name="twitter:image" content="https://myphonify.com/landing_assets/assets/img/logo.png">

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
                <a href="{{ route('welcome') }}"><img src="{{ asset('landing_assets/assets/img/logo.png') }}"
                        alt="" class="img-fluid"></a>
            </div>


            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Acceuil</a></li>
                    <li><a class="nav-link scrollto" href="#about"> Comment ça marche ? </a></li>
                    <li><a class="nav-link scrollto" href="#why-us">A propos</a></li>
                    <li><a class="nav-link scrollto" href="#clients">Services</a></li>
                    @if (Auth::user())
                        <li><a class="nav-link scrollto " href="{{ route('home') }}">Tableau de bord </a></li>
                    @else
                        <li><a class="nav-link scrollto " href="{{ route('login') }}">Se connecter</a></li>
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
                <img src="{{ asset('landing_assets/assets/img/acceuil.svg') }}" alt="" class="img-fluid">
            </div>

            <div class="hero-info" data-aos="zoom-in" data-aos-delay="100">
                <h2>
                    Achetez vos
                    <br>
                    numéros virtuels
                    <br>
                    à partir <br> de 2000 FCFA
                </h2>
                <div>
                    <a href="{{ route('purchase-numbers') }}" class="btn-services scrollto">Acheter</a>
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

                </header>

                <div class="row about-container">

                    <div class="col-lg-6 content order-lg-1 order-2">

                        <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                            <div class="icon"><i class="bi bi-plugin"></i></div>
                            <h4 class="title">Recharger votre compte</h4>
                            <p class="description">Rechargez facilement votre compte avec MyPhonify. Entrez le montant
                                souhaité et sélectionnez votre opérateur mobile. Profitez d'une recharge instantanée et
                                recevez une notification de confirmation. </p>
                        </div>

                        <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
                            <div class="icon"><i class="bi bi-cart3"></i></div>
                            <h4 class="title">Choisir le pays et le service</h4>
                            <p class="description">Sélectionnez le pays dont vous souhaitez acheter
                                numéro virtuel. Parcourez notre liste complète de pays disponibles et choisissez celui
                                qui correspond à vos besoins. Sélectionnez le service souhaité et procédez à l'achat en
                                toute simplicité.</p>
                        </div>

                        <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
                            <div class="icon"><i class="bi bi-check-circle-fill"></i></div>
                            <h4 class="title">Recevoir le code de confirmation</h4>
                            <p class="description">Utilisez votre numéro et recevez votre code de confirmation très
                                rapidement et en toute sécurité.</p>
                        </div>

                    </div>

                    <div class="col-lg-6 background order-lg-2" data-aos="zoom-in">
                        <img src="{{ asset('landing_assets/assets/img/about-img.svg') }}" class="img-fluid"
                            alt="">
                    </div>
                </div>

              


            </div>
        </section><!-- End About Section -->


        <!-- ======= Why Us Section ======= -->
        <section id="why-us">
            <div class="container" data-aos="fade-up">
                <header class="section-header">
                    <h3>Pourquoi nous choisir?</h3>
                    <p></p>
                </header>

                <div class="row row-eq-height justify-content-center">

                    <div class="col-lg-4 mb-4">
                        <div class="card" data-aos="zoom-in" data-aos-delay="100">
                            <i class="bi bi-shield-shaded"></i>
                            <div class="card-body">
                                <h5 class="card-title">Fiabilité</h5>
                                <p class="card-text"> Vous pouvez
                                    compter sur la stabilité et la disponibilité de nos numéros virtuels pour répondre à
                                    vos
                                    besoins. Notre engagement envers la fiabilité garantit que vous disposez d'un numéro
                                    virtuel performant et prêt à l'emploi. Faites confiance à notre fiabilité pour
                                    rester
                                    connecté(e) en toute tranquillité."</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 mb-4">
                        <div class="card" data-aos="zoom-in" data-aos-delay="200">
                            <i class="bi bi-lock-fill"></i>
                            <div class="card-body">
                                <h5 class="card-title">Sécurité</h5>
                                <p class="card-text"> Protégez vos informations personnelles et effectuez vos
                                    transactions en toute confiance grâce à notre site sécurisé et fiable. Nous mettons
                                    en place des mesures de sécurité avancées pour garantir la confidentialité de vos
                                    données et assurer la sécurité de chaque transaction que vous effectuez.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 mb-4">
                        <div class="card" data-aos="zoom-in" data-aos-delay="300">
                            <i class="bi bi-eye-fill"></i>

                            <div class="card-body">
                                <h5 class="card-title">Transparence</h5>
                                <p class="card-text">Nous croyons en la transparence dans nos opérations. Nous vous
                                    fournissons des informations claires et détaillées sur nos services, nos tarifs et
                                    nos politiques. Vous pouvez consulter toutes les informations nécessaires pour
                                    prendre des décisions éclairées concernant vos achats et transactions.
                                </p>
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
                    <h4 class="title text-center">Voici une liste des services que nous offrons</h4>
                </div>

                <div class="row g-0 clients-wrap clearfix" data-aos="zoom-in" data-aos-delay="100">

                    <div class="col-lg-3 col-md-4 col-xs-6">
                        <div class="client-logo">
                            <img src="{{ asset('landing_assets/assets/img/clients/whatsapp.png') }}"
                                class="img-fluid" alt="">
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-xs-6">
                        <div class="client-logo">
                            <img src="{{ asset('landing_assets/assets/img/clients/tiktok.png') }}" class="img-fluid"
                                alt="" width="80%">
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-xs-6">
                        <div class="client-logo">
                            <img src="{{ asset('landing_assets/assets/img/clients/telegram.png') }}"
                                class="img-fluid" alt="" width="80%">
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-xs-6">
                        <div class="client-logo">
                            <img src="{{ asset('landing_assets/assets/img/clients/gmail.jpg') }}" class="img-fluid"
                                alt="" width="80%">
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-xs-6">
                        <div class="client-logo">
                            <img src="{{ asset('landing_assets/assets/img/clients/chat-gpt.jpg') }}"
                                class="img-fluid" alt="" width="80%">
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-xs-6">
                        <div class="client-logo">
                            <img src="{{ asset('landing_assets/assets/img/clients/facebook.png') }}"
                                class="img-fluid" alt="">
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-xs-6">
                        <div class="client-logo">
                            <img src="{{ asset('landing_assets/assets/img/clients/insta.png') }}" class="img-fluid"
                                alt="" width="80%">
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-xs-6">
                        <div class="client-logo">
                            <img src="{{ asset('landing_assets/assets/img/clients/amazon.png') }}" class="img-fluid"
                                alt="" width="50%">
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
                &copy; Copyright <strong>Myphonify</strong>. Tous droits réservés
            </div>
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
