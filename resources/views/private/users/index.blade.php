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

    <h5 class="card-header ">Mes utilisateurs</h5>

    <div class="card py-4">
        <div class="table-responsive ">
            <table class="table table-striped" id="dataTable">
                <thead>
                    <tr class="text-nowrap">
                        <th class="text-center">Date</th>

                        <th class="text-center">Nom</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Solde</th>
                        <th class="text-center">Actions</th>
                        <th class="text-center">Plus</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="text-center">{{ $user->created_at }}</td>
                            <td class="text-center">{{ $user->name }}</td>
                            <td class="text-center">{{ $user->email }}</td>
                            <td class="text-center">{{ $user->account_balance }}</td>
                           
                            <td class="text-center">
                                @if ($user->status == 0)
                                    <a href="{{ route('private.users.block', $user->id) }}">
                                        <button class="btn btn-outline-danger">
                                            Bloquer
                                        </button>
                                    </a>
                                @else
                                    <a href="{{ route('private.users.unblock', $user->id) }}">
                                        <button class="btn btn-outline-success">
                                            Débloquer
                                        </button>
                                    </a>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('private.users.show', $user->id) }}">
                                    <button class="btn btn-outline-primary">
                                        Plus
                                    </button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
