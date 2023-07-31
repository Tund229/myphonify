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
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Mon compte 💰 </h6>
                    @if (Auth::user()->status == 0)
                        <span class="badge badge-success"><i class="fas fa-circle fa-xs"></i></span>
                    @else
                        <span class="badge badge-danger"><i class="fas fa-circle fa-xs"></i></span>
                    @endif
                </div>

                <div class="card-body ">
                    <div class="account-info">
                        <div class="info-item d-flex align-items-center justify-content-between mb-4">
                            <div class="d-flex align-items-center">
                                <div class="text-xs font-weight-bold">
                                    <h6 class="m-0">Solde:</h6>
                                </div>
                            </div>
                            <div class="info-amount">{{ Auth::user()->account_balance }} XOF</div>
                        </div>

                        <div class="info-item d-flex align-items-center justify-content-between mb-4">
                            <div class="d-flex align-items-center">
                                <div class="text-xs font-weight-bold">
                                    <h6 class="m-0">Numéros achetés:</h6>
                                </div>
                            </div>
                            <div class="info-amount">{{ Auth::user()->numbers()->where('state', 'validé')->count() }}</div>
                        </div>


                        <div class="info-item d-flex align-items-center justify-content-between mb-4">
                            <div class="d-flex align-items-center">
                                <div class="text-xs font-weight-bold">
                                    <h6 class="m-0">Gains par affiliation:</h6>
                                </div>
                            </div>
                            <div class="info-amount">O XOF</div>
                        </div>
                    </div>
                    <div class="text-center">
                        <input id="form-amount" type="number" name="amount" class="form-control">
                        <div id="error-message" style="color: red; padding-top:10px;"></div>

                    </div>

                    <div class="text-center">
                        <button class="btn btn-primary mt-4" id="pay-btn" type="button">Recharger mon compte
                        </button>
                    </div>
                    <div class="text-center mt-2">
                        <a href="{{ route('purchase-numbers') }}" class="btn btn-primary mt-4"> Acheter un numéro
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Listes des recharges</h6>

                </div>
                <div class="card-body">
                    <div class="table-responsive ">
                        <table class="table table-striped" id="dataTable">
                            <thead>
                                <tr class="text-nowrap">
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Montant</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Methode de paiement</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recharges as $recharge)
                                    <tr>
                                        <td class="text-center">{{ $recharge->created_at }}</td>
                                        <td class="text-center">{{ $recharge->amount }}</td>
                                        <td class="text-center">
                                            @if ($recharge->state == 'validé')
                                                <span class="badge bg-success">Validé</span>
                                            @elseif($recharge->state == 'en cours')
                                                <span class="badge bg-warning">En cours</span>
                                            @elseif($recharge->state == 'rejeté')
                                                <span class="badge bg-warning">Echoué</span>
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $recharge->paiement }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        document.getElementById("pay-btn").addEventListener("click", function(event) {
            event.preventDefault();
            var r_amount = document.getElementById('form-amount').value;
            if (r_amount === '' || parseInt(r_amount) < 100) {
                document.getElementById('error-message').innerText = 'Le montant doit être supérieur ou égal à 100f';
                return;
            }

            var email = "{{ Auth::user()->email }}";
            var username = "{{ Auth::user()->name }}";
            let widget = FedaPay.init({
                public_key: 'pk_sandbox_-NueTrbGAY_rtuv7jptYDnEt',
                transaction: {
                    amount: r_amount,
                    description: 'Nouvelle recharge'
                },
                customer: {
                    email: email,
                    lastname: username,
                    firstname: 'myphonify',
                },
                onComplete: function(result) {
                    if (result.reason == "CHECKOUT COMPLETE") {
                        var csrf = document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                        var xhttp = new XMLHttpRequest();
                        xhttp.open("POST", "/recharges?transaction_id=" + result.transaction.id, true);
                        xhttp.setRequestHeader("X-CSRF-TOKEN", csrf);
                        xhttp.onreadystatechange = function() {
                            console.log(this.status);
                            if (this.readyState == 4 && this.status == 200) {
                                var response = this.responseText;
                                if (response == "approved") {
                                    swal({
                                        title: "Compte rechargé avec succès",
                                        text: "Montant :" + r_amount + "XOF",
                                        timer: 10000,
                                        type: "success",
                                        confirmButtonColor: "#4169e1",
                                    });
                                    window.location.reload();
                                }
                            }
                        };
                        xhttp.send();
                    }

                }

            });
            widget.open();
        });
    </script>
@endsection
