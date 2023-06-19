@extends('layouts.app')

@section('content')
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
                        <h3 class="card-title text-nowrap mb-1 text-center">{{ $numbers_valide ->count()}}</h3>
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
@endsection
