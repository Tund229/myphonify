<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Inscription - Myphonify</title>
    <meta name="description"
        content="Inscrivez-vous sur Myphonify pour créer un compte et accéder à une gamme de numéros virtuels pour votre entreprise.">
    <meta name="keywords" content="inscription, créer un compte, Myphonify, numéros virtuels, entreprise">

    <!-- Balises Open Graph -->
    <meta property="og:title" content="Inscription - Myphonify">
    <meta property="og:description"
        content="Inscrivez-vous sur Myphonify pour créer un compte et accéder à une gamme de numéros virtuels pour votre entreprise.">
    <meta property="og:image" content="https://myphonify.com/landing_assets/assets/img/logo.png">
    <meta property="og:url" content="https://myphonify.com/signup">

    <!-- Balises Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Inscription - Myphonify">
    <meta name="twitter:description"
        content="Inscrivez-vous sur Myphonify pour créer un compte et accéder à une gamme de numéros virtuels pour votre entreprise.">
    <meta name="twitter:image" content="https://myphonify.com/landing_assets/assets/img/logo.png">


    <!-- Favicon -->
    <link href="{{ asset('landing_assets/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('landing_assets/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/css/core.css') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/css/pages/page-auth.css') }}" />
    <!-- Helpers -->
    <script src="{{ asset('dashboard/assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('dashboard/assets/js/config.js') }}"></script>
</head>

<body>
    <!-- Content -->

    <div class="container-xxl">
        @if (session()->has('error_message'))
            <div class="alert alert-danger mt-4 d-flex justify-content-center" role="alert"
                style="background-color: #e94c4c; color: #FFFFFF;">
                {{ session('error_message') }}
            </div>
        @endif
        <div class="authentication-wrapper authentication-basic container-p-y">

            <div class="authentication-inner">
                <!-- Register -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="{{ route('welcome') }}" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <img src="{{ asset('landing_assets/assets/img/logo.png') }}" alt=""
                                        class="img-fluid" style="width:150px; ">
                                </span>

                            </a>
                        </div>
                        <!-- /Logo -->
                        <h5 class="mb-4 text-center"> Inscrivez-vous 😊</h5>

                        <form class="mb-3" action="{{ route('register') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Nom d'utilisateur </label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Entrez un nom d'utilisateur " autofocus value="{{ old('name') }}" />
                            </div>
                            <div class="mb-4">
                                @error('name')
                                    <span class="text-danger text-center mb-4" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label for="email" class="form-label">Email </label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Entrez un email" autofocus value="{{ old('email') }}" />
                            </div>
                            <div class="mb-4">
                                @error('email')
                                    <span class="text-danger text-center mb-4" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="mb-3 mt-4 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Mot de passe</label>
                                </div>
                                <div class="input-group input-group-merge mb-4">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="Entrez un mot de passe" aria-describedby="password" />
                                </div>
                                <div class="mb-4">
                                    @error('password')
                                        <span class="text-danger text-center" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="terms"
                                        id="terms-conditions">
                                    <label class="form-check-label" for="terms-conditions">
                                        J'ai lu et j'accepte
                                        <a href="{{ route('privacy-terms') }}"> les conditions générales
                                            d'utilisation</a>
                                    </label>
                                </div>

                                <div class="mb-4">
                                    @error('terms')
                                        <span class="text-danger text-center" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100">S'inscrire</button>
                            </div>
                        </form>

                        <p class="text-center">
                            <span>Vous avez un compte?</span>
                            <a href="{{ route('login') }}">
                                <span> Connectez-vous</span>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>

    <!-- / Content -->



    <script src="{{ asset('dashboard/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('dashboard/assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{ asset('dashboard/assets/js/main.js') }}"></script>
    <script type="text/javascript">
        window.$crisp = [];
        window.CRISP_WEBSITE_ID = "58a684d2-be02-48fd-a382-fc47e3fbdb8a";
        (function() {
            d = document;
            s = d.createElement("script");
            s.src = "https://client.crisp.chat/l.js";
            s.async = 1;
            d.getElementsByTagName("head")[0].appendChild(s);
        })();
    </script>

</body>

</html>
