@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Details numéro achété par : <span class="badge rounded-pill bg-label-primary px-4">
                        {{ $number->user->name }} </span>
                </h5>

                <div class="card-body">
                    <div class="card py-4">
                        <div class="table-responsive ">
                            <table class="table table-striped" id="dataTable">
                                <thead>
                                    <tr class="text-nowrap">
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Service</th>
                                        <th class="text-center">Pays</th>
                                        <th class="text-center">Montant</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Message</th>
                                        <th class="text-center">Ip</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">{{ $number->created_at }}</td>
                                        <td class="text-center">{{ $number->service }}</td>
                                        <td class="text-center">{{ $number->country_name }}</td>
                                        <td class="text-center">{{ $number->amount }}</td>
                                        <td class="text-center">
                                            @if ($number->state == 'validé')
                                                <span class="badge bg-success">Validé</span>
                                            @elseif($number->state == 'en cours')
                                                <span class="badge bg-warning">En cours</span>
                                            @elseif($number->state == 'echoué')
                                                <span class="badge bg-danger">Echoué</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($number->message == null)
                                                📵
                                            @else
                                                <span style="cursor: pointer;"
                                                    onclick="showMessage('{{ $number->message }}')">💬</span>
                                            @endif
                                        </td>

                                        <td class="text-center">{{ $number->address_ip }}</td>

                                        <td class="text-center">

                                            @if ($number->state == 'validé' || $number->state == 'en cours')
                                                <a href="{{ route('private.numbers.block', $number->id) }}">
                                                    <button class="btn btn-outline-danger">Annuler</button>
                                                </a>
                                            @elseif($number->state == 'echoué')
                                                <a href="{{ route('private.numbers.unblock', $number->id) }}">
                                                    <button class="btn btn-outline-success">Valider</button>
                                                </a>
                                            @endif
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /Account -->
            </div>

        </div>

    </div>

    <div class="row">
        <div class="col-md-6 col-12 mb-md-0 mb-4">
            <div class="card">
                <h5 class="card-header">Détails de l'acheteur</h5>
                <div class="card-body">
                    <div class="d-flex mb-3">
                        <div class="flex-grow-1 row">
                            <div class="col-9 mb-sm-0 mb-2">
                                <h6 class="mb-0">IP Address:</h6>
                            </div>
                            <div class="col-3 text-end" id="ip-address">

                            </div>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="flex-grow-1 row">
                            <div class="col-9 mb-sm-0 mb-2">
                                <h6 class="mb-0">City: </h6>
                            </div>
                            <div class="col-3 text-end" id="city">

                            </div>
                        </div>
                    </div>
                    <div class="d-flex mb-3">

                        <div class="flex-grow-1 row">
                            <div class="col-9 mb-sm-0 mb-2">
                                <h6 class="mb-0">Region :</h6>
                            </div>
                            <div class="col-3 text-end" id="region">

                            </div>
                        </div>
                    </div>
                    <div class="d-flex mb-3">

                        <div class="flex-grow-1 row">
                            <div class="col-9 mb-sm-0 mb-2">
                                <h6 class="mb-0">Country</h6>
                            </div>
                            <div class="col-3 text-end" id="country">

                            </div>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="flex-grow-1 row">
                            <div class="col-9 mb-sm-0 mb-2">
                                <h6 class="mb-0">Latitude</h6>
                            </div>
                            <div class="col-3 text-end" id="latitude">

                            </div>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="flex-grow-1 row">
                            <div class="col-9 mb-sm-0 mb-2">
                                <h6 class="mb-0">Longitude: </h6>
                            </div>
                            <div class="col-3 text-end" id="longitude">

                            </div>
                        </div>
                    </div>
                    <!-- /Connections -->
                </div>
            </div>
        </div>
    </div>

    <script>
        const ipAddress = @json($number->address_ip);
    
        // Appeler l'API pour récupérer les détails de la position géographique
        fetch(`https://ipinfo.io/${ipAddress}/json`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('ip-address').textContent = data.ip;
                document.getElementById('city').textContent = data.city;
                document.getElementById('region').textContent = data.region;
                document.getElementById('country').textContent = data.country;
                document.getElementById('latitude').textContent = data.loc.split(',')[0];
                document.getElementById('longitude').textContent = data.loc.split(',')[1];
            })
            .catch(error => console.error('Error fetching IP details:', error));
    </script>
    
@endsection
