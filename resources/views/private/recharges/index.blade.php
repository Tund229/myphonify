@extends('layouts.app')

@section('content')
    <style>
        #dataTable_paginate {

            margin: 0 auto;
            text-align: center;
            margin-bottom: 20px;
        }

        #dataTable {
            padding: 20px 0;
        }

        #dataTable thead th {
            background-color: #f5f5f5;
            font-weight: bold;
            border-top: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
            padding: 8px;
        }

        #dataTable tbody td {
            border-bottom: 1px solid #ddd;
            padding: 8px;
        }

        #dataTable_paginate .paginate_button {
            background-color: transparent;
            color: #000;
            border: 1px solid #ddd;
            padding: 3px 8px;
            margin-right: 2px;
            transition: background-color 0.3s;
            cursor: pointer;

        }

        #dataTable_paginate .paginate_button.current {
            background-color: #5c7ee5;
            color: white;
            border: 1px solid #5c7ee5;
            padding: 3px 8px;
            margin-right: 2px;
        }

        #dataTable_filter {
            text-align: center;
            margin: 0 auto;
        }

        #dataTable_filter>label>input[type="search"] {


            padding: 0.4375rem 0.875rem;
            font-size: 0.9375rem;
            font-weight: 400;
            line-height: 1.53;
            color: #697a8d;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #d9dee3;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 0.375rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        #dataTable_filter>label>input[type="search"]:focus {
            outline: 1px solid #5c7ee5;

            padding: 0.4375rem 0.875rem;
            font-size: 0.9375rem;
            font-weight: 400;
            line-height: 1.53;
            color: #697a8d;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #d9dee3;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 0.375rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
    </style>

    <h5 class="card-header ">Recharges</h5>
    <button type="button" data-bs-toggle="modal" data-bs-target="#smallModal"
        class="btn btn-outline-primary account-image-reset mb-4">
        Recharger
    </button>
    <div class="card py-4">

        <div class="table-responsive ">
            <table class="table table-striped" id="dataTable">
                <thead>
                    <tr class="text-nowrap">
                        <th class="text-center">Date</th>
                        <th class="text-center">Montant</th>
                        <th class="text-center">Utilisateur</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Methode de paiement</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recharges as $recharge)
                        <tr>
                            <td class="text-center">{{ $recharge->created_at }}</td>
                            <td class="text-center">{{ $recharge->amount }}</td>
                            <td class="text-center">{{ $recharge->user->name }}</td>
                            <td class="text-center">
                                @if ($recharge->state == 'validé')
                                    <span class="badge bg-success">Validé</span>
                                @elseif($recharge->state == 'en cours')
                                    <span class="badge bg-warning">En cours</span>
                                @elseif($recharge->state == 'echoué')
                                    <span class="badge bg-danger">Echoué</span>
                                @endif
                            </td>
                            <td class="text-center">{{ $recharge->paiement }}</td>
                            <td class="text-center">
                                @if ($recharge->state == 'validé')
                                    <a href="{{ route('private.recharges.block', $recharge->id) }}">
                                        <button class="btn btn-outline-danger">
                                            Annuler </button>
                                    </a>
                                @else
                                    <a href="{{ route('private.recharges.unblock', $recharge->id) }}">
                                        <button class="btn btn-outline-success">
                                            Valider
                                        </button>
                                    </a>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
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
                                        <label for="nameSmall" class="form-label">Utilisateurs</label>
                                        <input type="text" id="nameSmall" class="form-control" name="user" />
                                        @error('user')
                                            <span role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror

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
