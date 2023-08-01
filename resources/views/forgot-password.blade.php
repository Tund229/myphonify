<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <title>Mot de passe oublié - Myphonify</title>

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <meta name="description"
        content="Récupérez votre Myphonify pour accéder à votre compte et gérer vos numéros virtuels.">
    <meta name="keywords" content="connexion, compte, Myphonify, numéros virtuels, gestion">

    <!-- Balises Open Graph -->
    <meta property="og:title" content="Connexion - Myphonify">
    <meta property="og:description"
        content="Connectez-vous à Myphonify pour accéder à votre compte et gérer vos numéros virtuels.">
    <meta property="og:image" content="https://myphonify.com/landing_assets/assets/img/logo.png">
    <meta property="og:url" content="https://myphonify.com/login">

    <!-- Balises Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Connexion - Myphonify">
    <meta name="twitter:description"
        content="Connectez-vous à Myphonify pour accéder à votre compte et gérer vos numéros virtuels.">
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

        @if (session()->has('status'))
            <div class="alert alert-danger mt-4 d-flex justify-content-center" role="alert"
                style="background-color: green; color: #FFFFFF;">
                {{ session('status') }}
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
                        <h5 class="mb-4 text-center"> Vous avez oublié votre mot de passe 😊</h5>

                        <form class="mb-3" action="{{ route('forgoted_password') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email </label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Entrez votre email" autofocus value="{{ old('email') }}" />
                            </div>
                            <div class="mb-4">
                                @error('email')
                                    <span class="text-danger text-center mb-4" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Récupérer</button>
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

</body>

</html>
