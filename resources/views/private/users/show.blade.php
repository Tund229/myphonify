@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-md-row mb-3">
                <li class="nav-item">
                    <a class="nav-link @if ($title == 'Détails utilisateur') active @endif" href="{{route('private.users.show', $user->id)}}"><i
                            class="bx bx-user me-1"></i> Compte</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link @if ($title == 'Recharges utilisateur') active @endif"
                        href="{{ route('private.users.user_recharges', $user->id) }}"><i class="bx bx-bell me-1"></i>
                        Recharges</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if ($title == 'Numéros utilisateur') active @endif" href="{{ route('private.users.user_numbers', $user->id) }}"><i
                            class="bx bx-link-alt me-1"></i>
                        Achats</a>
                </li>
            </ul>
            <div class="card mb-4">
                <h5 class="card-header">Details utilisateur <span
                        class="badge rounded-pill bg-label-primary px-4">{{ $user->identifiant }}</span>
                </h5>
                <!-- Account -->
                <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <div class="button-wrapper">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#smallModal"
                                class="btn btn-outline-primary account-image-reset mb-4">
                                Recharger
                            </button>

                        </div>
                    </div>
                </div>
                <hr class="my-0" />
                <div class="card-body">
                    <form id="formAccountSettings">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="firstName" class="form-label">Nom d'utilisateur</label>
                                <input class="form-control" type="text" disabled value="{{ $user->name }}" autofocus />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="lastName" class="form-label">Email</label>
                                <input class="form-control" type="text" value="{{ $user->email }}" disabled />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Solde</label>
                                <input class="form-control" type="text" disabled value="{{ $user->account_balance }}" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="organization" class="form-label">Gain sur affiliation</label>
                                <input type="text" class="form-control" value="{{ $user->affiliate_exarnings }}"
                                    disabled />
                            </div>
                        </div>
                        <div class="mt-2">
                            <a href="{{ route('private.users.reset_password', $user->id) }}"
                                class="btn btn-outline-warning account-image-reset mb-4">
                                Reset mot de passe

                            </a>
                        </div>
                    </form>
                </div>
                <!-- /Account -->
            </div>
           
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="modal fade" id="smallModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel2">Recharger</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('private.recharges.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col mb-3">
                                        <input type="number" value="{{ $user->id }}" class="form-control"
                                            name="user_id" hidden />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="nameSmall" class="form-label">Montant</label>
                                        <input type="number" id="nameSmall" class="form-control" name="amount"
                                            value="{{ old('amount') }}" />
                                    </div>
                                    @error('amount')
                                        <span role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Valider</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
