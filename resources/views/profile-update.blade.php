@extends('layouts.app')

@section('content')
    <div class="row">
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
                <h5 class="card-header">Modifier vos informations
                </h5>
                <!-- Account -->
                <hr class="my-0" />
                <div class="card-body">
                    <form id="formAccountSettings" method="POST" action="{{route('update')}}">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="firstName" class="form-label">Nom d'utilisateur</label>
                                <input class="form-control" type="text" value="{{ $user->name }}" autofocus name="name"/>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="lastName" class="form-label">Email</label>
                                <input class="form-control" type="email" value="{{ $user->email }}" name="email"/>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="organization" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control" name="password"
                                             />
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
