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





    <div class="col-md-12 col-12 mt-4">
        <div class="card">
            <h5 class="card-header">Statistiques des ventes </h5>
            <div class="card-body">
                <canvas id="userStatsChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-12 mt-4">
        <div class="card">
            <h5 class="card-header">Statistiques des montants</h5>
            <div class="card-body">
                <canvas id="statsChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-12 mt-4">
        <div class="card">
            <h5 class="card-header">Statistiques par jour</h5>
            <div class="card-body">
                <canvas id="statsChartByDay"></canvas>
            </div>
        </div>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Les labels communs pour les deux graphiques
        const labels = @json($labels);

        // Les données pour le graphique à barres (Bar Chart)
        const data_users = @json($data_users);
        const data_recharges = @json($data_recharges);
        const data_numbers_achetes = @json($data_numbers_achetes);
        const data_numbers_echoues = @json($data_numbers_echoues);

        // Les données pour le graphique en courbe (Line Chart)
        const data_recharges_sum = @json($data_recharges_sum);
        const data_numbers_achetes_sum = @json($data_numbers_sum);

        // Créer le graphique à barres
        const ctxUserStats = document.getElementById('userStatsChart').getContext('2d');
        const userStatsChart = new Chart(ctxUserStats, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Utilisateurs',
                        data: data_users,
                        backgroundColor: 'rgba(255, 99, 132, 0.8)',
                        borderWidth: 1
                    },
                    {
                        label: 'Recharges',
                        data: data_recharges,
                        borderColor: 'rgba(255, 206, 86, 1)',
                        backgroundColor: 'rgba(255, 206, 86, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Numéros achetés',
                        data: data_numbers_achetes,
                        backgroundColor: 'rgba(75, 192, 192, 0.8)',
                        borderWidth: 1
                    },
                    {
                        label: 'Numéros échoués',
                        data: data_numbers_echoues,
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
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

        // Créer le graphique en courbe
        const ctxStats = document.getElementById('statsChart').getContext('2d');
        const statsChart = new Chart(ctxStats, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Recharges',
                        data: data_recharges_sum,
                        borderColor: 'rgba(255, 206, 86, 1)',
                        backgroundColor: 'rgba(255, 206, 86, 0.8)',
                        borderWidth: 1,
                        fill: true, // Activer les courbes pour ce dataset
                        tension: 0.4 // Contrôler l'intensité des courbes (valeurs entre 0 et 1)
                    },
                    {
                        label: 'Numéros achetés',
                        data: data_numbers_achetes_sum,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.8)',
                        borderWidth: 1,
                        fill: true, // Activer les courbes pour ce dataset
                        tension: 0.4 // Contrôler l'intensité des courbes (valeurs entre 0 et 1)
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
                        text: 'Statistiques mensuelles'
                    }
                }
            }
        });




        // Récupérer les données pour chaque catégorie
        const data_recharges_by_day = @json($chart_recharges_by_day);
        const data_numbers_achetes_by_day = @json($chart_numbers_achetes_by_day);
        const data_numbers_echoues_by_day = @json($chart_numbers_echoues_by_day);

        // Convertir les données en tableaux pour Chart.js
        const labelsByDay = Object.keys(data_recharges_by_day).map(date => new Date(date).toLocaleDateString());
        const rechargesByDay = Object.values(data_recharges_by_day);
        const numbersAchetesByDay = Object.values(data_numbers_achetes_by_day);
        const numbersEchouesByDay = Object.values(data_numbers_echoues_by_day);

        const ctxStatsByDay = document.getElementById('statsChartByDay').getContext('2d');
        const statsChartByDay = new Chart(ctxStatsByDay, {
            type: 'line',
            data: {
                labels: labelsByDay,
                datasets: [{
                        label: 'Recharges',
                        data: rechargesByDay,
                        borderColor: 'rgba(255, 99, 132, 1)',
                        backgroundColor: 'rgba(255, 99, 132, 0.5)',
                        borderWidth: 2,
                        pointBackgroundColor: 'rgba(255, 99, 132, 1)',
                        pointRadius: 5,
                        fill: true,
                        tension: 0.4 // Ajustez cette valeur pour modifier l'intensité de la courbe
                    },
                    {
                        label: 'Numéros achetés',
                        data: numbersAchetesByDay,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.5)',
                        borderWidth: 2,
                        pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                        pointRadius: 5,
                        fill: true,
                        tension: 0.4 // Ajustez cette valeur pour modifier l'intensité de la courbe
                    },
                    {
                        label: 'Numéros échoués',
                        data: numbersEchouesByDay,
                        borderColor: 'rgba(0, 0, 0, 0.8)',
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        borderWidth: 2,
                        pointBackgroundColor: 'rgba(255, 206, 86, 1)',
                        pointRadius: 5,
                        fill: true,
                        tension: 0.4 // Ajustez cette valeur pour modifier l'intensité de la courbe
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                size: 14
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: 'Statistiques par jour',
                        font: {
                            size: 18
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            font: {
                                size: 14
                            }
                        }
                    },
                    y: {
                        ticks: {
                            font: {
                                size: 14
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection
