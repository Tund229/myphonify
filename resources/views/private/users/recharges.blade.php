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


    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-md-row mb-3">
                <li class="nav-item">
                    <a class="nav-link @if ($title == 'Détails utilisateur') active @endif"
                        href="{{ route('private.users.show', collect(request()->segments())->last()) }}"><i
                            class="bx bx-user me-1"></i> Compte</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link @if ($title == 'Recharges utilisateur') active @endif"
                        href="{{ route('private.users.user_recharges', collect(request()->segments())->last()) }}"><i
                            class="bx bx-bell me-1"></i>
                        Recharges</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if ($title == 'Numéros utilisateur') active @endif"
                        href="{{ route('private.users.user_numbers', collect(request()->segments())->last()) }}"><i
                            class="bx bx-link-alt me-1"></i>
                        Achats</a>
                </li>
            </ul>
            <div class="card mb-4">
                <h5 class="card-header">Recharges utilisateur</h5>
                <!-- Account -->
                <div class="card-body">
                    <div class="table-responsive ">
                        <table class="table table-striped" id="dataTable">
                            <thead>
                                <tr class="text-nowrap">
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Montant</th>
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
                                        <td class="text-center">
                                            @if ($recharge->state == "validé")
                                                <span class="badge bg-success">Validé</span>
                                            @elseif($recharge->state == "en cours")
                                                <span class="badge bg-warning">En cours</span>
                                            @elseif($recharge->state == "rejeté")
                                            <span class="badge bg-warning">Echoué</span>
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $recharge->paiement }}</td>
                                        <td class="text-center">
                                            @if ($recharge->state == 'validé')
                                                <a href="#">
                                                    <button class="btn btn-outline-danger">
                                                        Annuler                                                        </button>
                                                </a>
                                            @else
                                                <a href="#">
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
                </div>

            </div>

        </div>


    </div>
@endsection
