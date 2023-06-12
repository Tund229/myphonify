<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Myphonify - {{ $title }}</title>

    <meta name="description" content="" />

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

    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('dashboard/assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('dashboard/assets/js/config.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
   

</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="index.html" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <img src="{{ asset('landing_assets/assets/img/logo.png') }}" alt=""
                                class="img-fluid" style="width:120px; ">
                        </span>
                    </a>

                    <a href="javascript:void(0);"
                        class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- dashboard -->
                    <li class="menu-item active">
                        <a href="index.html" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Analytics">Mon compte</div>
                        </a>
                    </li>



                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Numéros</span>
                    </li>
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-dock-top"></i>
                            <div data-i18n="Account Settings">Numéros</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="pages-account-settings-account.html" class="menu-link">
                                    <div data-i18n="Account">Nouveau numéro</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="pages-account-settings-notifications.html" class="menu-link">
                                    <div data-i18n="Notifications">Mes numéros</div>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <!-- Components -->
                    <li class="menu-header small text-uppercase"><span class="menu-header-text">Recharges</span></li>
                    <!-- Cards -->

                    <!-- User interface -->
                    <li class="menu-item">
                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-box"></i>
                            <div data-i18n="User interface">Recharges</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="ui-accordion.html" class="menu-link">
                                    <div data-i18n="Accordion">Recharges</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="ui-alerts.html" class="menu-link">
                                    <div data-i18n="Alerts">Mes recharges</div>
                                </a>
                            </li>

                        </ul>
                    </li>



                    <!-- Forms & Tables -->
                    {{-- <li class="menu-header small text-uppercase"><span class="menu-header-text">Forms &amp;
                            Tables</span></li>
                    <!-- Forms -->
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-detail"></i>
                            <div data-i18n="Form Elements">Form Elements</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="forms-basic-inputs.html" class="menu-link">
                                    <div data-i18n="Basic Inputs">Basic Inputs</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="forms-input-groups.html" class="menu-link">
                                    <div data-i18n="Input groups">Input groups</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-detail"></i>
                            <div data-i18n="Form Layouts">Form Layouts</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="form-layouts-vertical.html" class="menu-link">
                                    <div data-i18n="Vertical Form">Vertical Form</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="form-layouts-horizontal.html" class="menu-link">
                                    <div data-i18n="Horizontal Form">Horizontal Form</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Tables -->
                    <li class="menu-item">
                        <a href="tables-basic.html" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-table"></i>
                            <div data-i18n="Tables">Tables</div>
                        </a>
                    </li> --}}
                    <!-- Misc -->
                    <li class="menu-header small text-uppercase"><span class="menu-header-text">Aide &amp;
                            Assitance</span></li>
                    <li class="menu-item">
                        <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                            target="_blank" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-support"></i>
                            <div data-i18n="Support">Support</div>
                        </a>
                    </li>
                </ul>
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- Search -->
                        <div class="navbar-nav align-items-center">
                            <div class="nav-item d-flex align-items-center font-bold">
                                {{ Auth::user()->name }}
                            </div>
                        </div>
                        <!-- /Search -->
                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="{{ asset('dashboard/assets/img/avatars/1.png') }}" alt
                                            class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">

                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="bx bx-user me-2"></i>
                                            <span class="align-middle">My Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="bx bx-cog me-2"></i>
                                            <span class="align-middle">Settings</span>
                                        </a>
                                    </li>
                                    {{-- <li>
                                        <a class="dropdown-item" href="#">
                                            <span class="d-flex align-items-center align-middle">
                                                <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                                                <span class="flex-grow-1 align-middle">Billing</span>
                                                <span
                                                    class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                                            </span>
                                        </a>
                                    </li> --}}
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="bx bx-power-off me-2"></i>
                                            <span class="align-middle">Déconnexion</span>
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>


                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </nav>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">

                        <div class="row">
                            <div class="col-lg-12 mb-2 order-0">
                                <div class="alert alert-success alert-dismissible fade show text-black"
                                    role="alert">
                                    <div class="d-flex align-items-end row">
                                        <div class="col-sm-7">
                                            <div class="card-body">
                                                <h5 class="card-title text-primary">{{ Auth::user()->name }}</h5>
                                                <p class="mb-4">
                                                    Rejoignez notre canal <span class="fw-bold">Telegram</span> pour
                                                    les dernières mises à jour!
                                                    🚀📢
                                                </p>
                                                <a href="#" class="btn btn-sm btn-outline-primary">
                                                    Rejoindre
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-sm-5 text-center text-sm-left">
                                            <div class="card-body pb-0 px-0 px-md-4">
                                                <img src="{{ asset('dashboard/assets/img/illustrations/man-with-laptop-light.png') }}"
                                                    height="140" alt="View Badge User"
                                                    data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                                    data-app-light-img="illustrations/man-with-laptop-light.png" />
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-4 order-1">
                                <div class="row">
                                    <div class="col-lg-3 col-md-12 col-6 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div
                                                    class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <img src="{{ asset('dashboard/assets/img/icons/unicons/wallet-info.png') }}"
                                                            alt="chart success" class="rounded" />
                                                    </div>

                                                    <span class="fw-semibold d-block mb-1">Solde</span>
                                                </div>
                                                <h3 class="card-title mb-2">{{ Auth::user()->account_balance }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-12 col-6 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div
                                                    class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <img src="{{ asset('dashboard/assets/img/icons/unicons/wallet-info.png') }}"
                                                            alt="Credit Card" class="rounded" />
                                                    </div>

                                                    <span class="fw-semibold d-block mb-1">Numéros</span>
                                                </div>
                                                <h3 class="card-title text-nowrap mb-1 text-center">$4,679</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-12 col-6 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div
                                                    class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <img src="{{ asset('dashboard/assets/img/icons/unicons/wallet-info.png') }}"
                                                            alt="Credit Card" class="rounded" />
                                                    </div>

                                                    <span class="fw-semibold d-block mb-1">Numéros</span>
                                                </div>
                                                <h3 class="card-title text-nowrap mb-1 text-center">$4,679</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-12 col-6 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div
                                                    class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <img src="{{ asset('dashboard/assets/img/icons/unicons/globe.png') }}"
                                                            alt="Credit Card" class="rounded" />
                                                    </div>

                                                    <span class="fw-semibold d-block mb-1">Sales</span>
                                                </div>
                                                <h3 class="card-title text-nowrap mb-1 text-center">
                                                    {{ $countries_count }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @yield('content')

                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl d-flex flex-wrap justify-content-center ">
                            <div>
                                ©
                                <script>
                                    document.write(new Date().getFullYear());
                                </script>
                                Tous droits réservés , Myphonify
                            </div>
                        </div>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('dashboard/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('dashboard/assets/vendor/js/menu.j') }}s"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('dashboard/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('dashboard/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('dashboard/assets/js/dashboards-analytics.js') }}"></script>

    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "language": {
                    "sEmptyTable": "Aucune donnée disponible dans le tableau",
                    "sInfo": "Affichage de l'élément _START_ à _END_ sur _TOTAL_ éléments",
                    "sInfoEmpty": " 0 à 0 sur 0 élément",
                    "sInfoFiltered": "(filtré à partir de _MAX_ éléments au total)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ",",
                    "sLengthMenu": "Afficher _MENU_ éléments",
                    "sLoadingRecords": "Chargement...",
                    "sProcessing": "Traitement...",
                    "sSearch": "Rechercher :",
                    "sZeroRecords": "Aucun élément correspondant trouvé",
                    "oPaginate": {
                        "sFirst": "Premier",
                        "sLast": "Dernier",
                        "sNext": "Suiv.",
                        "sPrevious": "Préc."
                    },
                    "oAria": {
                        "sSortAscending": ": activer pour trier la colonne par ordre croissant",
                        "sSortDescending": ": activer pour trier la colonne par ordre décroissant"
                    }
                }
            });
        });
    </script>

</body>

</html>
