@extends('layouts.app')

@section('content')
    <div class="container-xxl container-p-y text-center">
        <div class="misc-wrapper">
            <h2 class="mb-2 mx-2">Bientôt Disponible</h2>
            <div class="mt-2">
                <img src="{{ asset('dashboard/assets/img/illustrations/coming_soon.png') }}" alt="girl-doing-yoga-light"
                    width="300" class="img-fluid" data-app-dark-img="illustrations/girl-doing-yoga-dark.png"
                    data-app-light-img="illustrations/girl-doing-yoga-light.png" />
            </div>
        </div>
    </div>
@endsection
