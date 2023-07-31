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

                                        <td class="text-center">

                                            @if ($number->state == 'validé')
                                                <a href="{{ route('private.numbers.block', $number->id) }}">
                                                    <button class="btn btn-outline-danger">Annuler</button>
                                                </a>
                                            @else
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
@endsection
