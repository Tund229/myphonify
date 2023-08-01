@extends('layouts.app')

@section('content')
    <div class="row">
        @if (session()->has('status'))
            <div class="alert alert-success mt-4 d-flex justify-content-center" role="alert"
                style="background-color: green; color: #FFFFFF;">
                {{ session('status') }}
            </div>
        @endif
        <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-md-row mb-3">
                <li class="nav-item">
                    <a class="nav-link @if ($title == 'Mon Profil') active @endif" href="{{ route('profile') }}"><i
                            class="bx bx-user me-1"></i> Profil</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link @if ($title == 'Modifier Profil') active @endif"
                        href="{{ route('profile_update') }}"><i class="bx bx-bell me-1"></i>
                        Modifier</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if ($title == 'Sécurité Profil') active @endif"
                        href="{{ route('password_update') }}"><i class="bx bx-link-alt me-1"></i>
                        Sécurité</a>
                </li>
            </ul>
            <div class="card mb-4">
                <h5 class="card-header">Modifier le mot de passe
                </h5>
                <!-- Account -->
                <hr class="my-0" />
                <div class="card-body">
                    <form id="formAccountSettings" method="POST" action="{{ route('password_updated') }}">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="firstName" class="form-label">Ancien mot de passe</label>
                                <input class="form-control" type="password" name="old_password" />

                                <div class="mb-4">
                                    @error('old_password')
                                        <span class="text-danger text-center mb-4" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="lastName" class="form-label">Nouveau mot de passe</label>
                                <input class="form-control" type="password" name="new_password" />

                                <div class="mb-4">
                                    @error('new_password')
                                        <span class="text-danger text-center mb-4" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="organization" class="form-label">Confirmer nouveau mot de passe</label>
                                <input type="password" class="form-control" name="new_password_confirmation" />
                                <div class="mb-4">
                                    @error('new_password_confirmation')
                                        <span class="text-danger text-center mb-4" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button class="btn btn-outline-warning account-image-reset mb-4" type="submit">
                                Modifier
                            </button>
                        </div>
                    </form>
                </div>
                <!-- /Account -->
            </div>

        </div>
    </div>
@endsection
