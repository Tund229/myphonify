<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Myphonify - Sign In</title>
    <!-- Favicons -->
    <link href="{{ asset('landing_assets/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('landing_assets/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Custom fonts for this template-->
    <link href="{{ asset('dashboard_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet"
        type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('dashboard_assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body>


    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            @if (session()->has('error_message'))
                <div class="alert alert-danger mt-4" role="alert" style="background-color: #d12828; color: #FFFFFF;">
                    {{ session('error_message') }}
                </div>
            @endif

            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">
                            </div>
                            <div class="col-lg-6">
                                <div class="px-5 pb-5">
                                    <div class="text-center">
                                        <a href="#">
                                            <img src="{{ asset('landing_assets/assets/img/logo.png') }}" alt=""
                                                class="img-fluid" style="width:150px; ">
                                        </a>
                                    </div>
                                    <form class="user" action="{{ route('login') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address" name="email">
                                            @error('email')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password" name="password">
                                            @error('password')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <button class="btn btn-primary btn-user btn-block">
                                            Sign In
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a style="color: black" class="small" href="#">Forgot password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('register') }}"
                                            style="text-decoration: none">Sign up</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('dashboard_assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('dashboard_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('dashboard_assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('dashboard_assets/js/sb-admin-2.min.js') }}"></script>


</body>

</html>
