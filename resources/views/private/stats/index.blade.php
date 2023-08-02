@extends('layouts.app')

@section('content')
    <style>
        .chart-container {
            position: relative;
            width: 100%;
            overflow-x: auto;
            /* Rendre la div scrollable horizontalement sur les petits écrans */
        }

        /* Optionnel : ajuster la hauteur du conteneur selon vos besoins */
        .chart-container canvas {
            height: 300px;
            /* Ajustez la hauteur selon vos préférences */
        }
    </style>
    <div class="col-lg-12 col-md-4 order-1">

        <div class="row">
            <div class="col-lg-3 col-md-12 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="{{ asset('dashboard/assets/img/icons/unicons/wallet-info.png') }}"
                                    alt="chart success" class="rounded" />
                            </div>
                            <span class="fw-semibold d-block mb-1">Utilisateurs</span>
                        </div>
                        <h3 class="card-title mb-2 text-center">{{ $users->count() }}
                        </h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-12 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="{{ asset('dashboard/assets/img/icons/unicons/wallet-info.png') }}"
                                    alt="Credit Card" class="rounded" />
                            </div>

                            <span class="fw-semibold d-block mb-1">Recharges</span>
                        </div>
                        <h3 class="card-title text-nowrap mb-1 text-center">{{ $recharges->count() }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-12 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="{{ asset('dashboard/assets/img/icons/unicons/wallet-info.png') }}"
                                    alt="Credit Card" class="rounded" />
                            </div>

                            <span class="fw-semibold d-block mb-1">Montant recharges</span>
                        </div>
                        <h3 class="card-title text-nowrap mb-1 text-center">{{ $recharges->sum('amount') }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-12 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="{{ asset('dashboard/assets/img/icons/unicons/globe.png') }}" alt="Credit Card"
                                    class="rounded" />
                            </div>

                            <span class="fw-semibold d-block mb-1">Solde courant</span>
                        </div>
                        <h3 class="card-title text-nowrap mb-1 text-center">
                            {{ $users->sum('account_balance') }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-12 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="{{ asset('dashboard/assets/img/icons/unicons/wallet-info.png') }}"
                                    alt="chart success" class="rounded" />
                            </div>
                            <span class="fw-semibold d-block mb-1">Chiffre d'affaire</span>
                        </div>
                        <h3 class="card-title mb-2 text-center">{{ $numbers_valide->sum('amount') }}
                        </h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-12 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="{{ asset('dashboard/assets/img/icons/unicons/wallet-info.png') }}"
                                    alt="Credit Card" class="rounded" />
                            </div>

                            <span class="fw-semibold d-block mb-1">Numéros validés</span>
                        </div>
                        <h3 class="card-title text-nowrap mb-1 text-center">{{ $numbers_valide->count() }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-12 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="{{ asset('dashboard/assets/img/icons/unicons/wallet-info.png') }}"
                                    alt="Credit Card" class="rounded" />
                            </div>

                            <span class="fw-semibold d-block mb-1">Numéros en cours</span>
                        </div>
                        <h3 class="card-title text-nowrap mb-1 text-center">{{ $numbers_en_cours }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-12 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="{{ asset('dashboard/assets/img/icons/unicons/globe.png') }}" alt="Credit Card"
                                    class="rounded" />
                            </div>

                            <span class="fw-semibold d-block mb-1">Numéros échoués</span>
                        </div>
                        <h3 class="card-title text-nowrap mb-1 text-center">
                            {{ $numbers_echoue }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



    <div class="chart-container">
        <canvas id="userStatsChart" width="400" height="200"></canvas>
    </div>


    <script>
        const labels = @json($labels);
        const data_users = @json($data_users);
        const data_recharges = @json($data_recharges);
        const data_numbers_achetes = @json($data_numbers_achetes);

        const ctx = document.getElementById('userStatsChart').getContext('2d');
        const userStatsChart = new Chart(ctx, {
            type: 'bar', // Utilisons un graphique à barres empilées (Stacked Bar Chart)
            data: {
                labels: labels,
                datasets: [{
                        label: 'Utilisateurs',
                        data: data_users,
                        backgroundColor: 'rgba(255, 99, 132, 0.8)', // Couleur rouge pour les utilisateurs
                        borderWidth: 1
                    },
                    {
                        label: 'Recharges',
                        data: data_recharges,
                        backgroundColor: 'rgba(54, 162, 235, 0.8)', // Couleur bleue pour les recharges
                        borderWidth: 1
                    },
                    {
                        label: 'Numéros achetés',
                        data: data_numbers_achetes,
                        backgroundColor: 'rgba(75, 192, 192, 0.8)', // Couleur verte pour les numéros achetés
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Positifs'
                    }
                },

            }
        });
    </script>
@endsection
