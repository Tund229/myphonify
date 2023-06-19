@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-pills flex-column flex-md-row mb-3">
            <li class="nav-item">
                <a class="nav-link @if ($title == 'Mon Profil') active @endif" href="{{route('profile')}}"><i
                        class="bx bx-user me-1"></i> Profil</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link @if ($title == 'Modifier Profil') active @endif"
                    href="{{route('profile_update')}}"><i class="bx bx-bell me-1"></i>
                    Modifier</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if ($title == 'Sécurité Profil') active @endif" href="{{route('password_update')}}"><i
                        class="bx bx-link-alt me-1"></i>
                    Sécurité</a>
            </li>
        </ul>
        <div class="card mb-4">
            <h5 class="card-header">Identifiant <span
                    class="badge rounded-pill bg-label-primary px-4">{{ $user->identifiant }}</span>
            </h5>
            <!-- Account -->
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
                </form>
            </div>
            <!-- /Account -->
        </div>
       
    </div>
</div>
@endsection
