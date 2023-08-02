<div>
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

    <h5 class="card-header ">Mes numéros</h5>

    <div class="card py-4">
        <div class="table-responsive">
            <table class="table table-striped" id="dataTable">
                <thead>
                    <tr class="text-nowrap">
                        <th class="text-center">Status</th>
                        <th class="text-center">Msgs</th>
                        <th class="text-center">Pays</th>
                        <th class="text-center">Numéros</th>
                        <th class="text-center">Services</th>
                        <th class="text-center">Time</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($numbers as $number)
                        <tr>
                            <td class="text-center">
                                @if ($number->state == 'validé')
                                    <span class="badge bg-success">Validé</span>
                                @elseif($number->state == 'en cours')
                                    <span class="badge bg-warning">En cours</span>
                                @elseif ($number->state == 'echoué')
                                    <span class="badge bg-danger">Echoué</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($number->message == null)
                                    -
                                @else
                                    <span style="cursor: pointer;"
                                        onclick="showMessage('{{ $number->message }}')">💬</span>
                                @endif
                            </td>
                            <td class="text-center">{{ strtoupper($number->country_name) }}</td>
                            <td class="text-center">{{ $number->phone }}</td>
                            <td class="text-center">{{ strtoupper($number->service) }}</td>
                            @if ($number->phone && $number->state == 'en cours')
                                <td class="text-center text-success" id="counter">
                                    <script>
                                        <?php
                                        $dateTime = strtotime($number->created_at);
                                        $getDateTime = date('F d, Y H:i:s', $dateTime);
                                        $add_min = date('Y-m-d H:i:s', strtotime($getDateTime . '+10 minutes'));
                                        
                                        ?>
                                        var countDownDate = new Date("<?php echo "$add_min"; ?>").getTime();
                                        // Update the count down every 1 second
                                        var x = setInterval(function() {
                                            var now = new Date().getTime();
                                            // Find the distance between now an the count down date
                                            var distance = countDownDate - now;
                                            // Time calculations for days, hours, minutes and seconds
                                            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                            // Output the result in an element with id="counter"11
                                            document.getElementById("counter").innerHTML =
                                                minutes + " m " + " : " + seconds + " s ";
                                            // If the count down is over, write some text 
                                            if (distance < 0) {
                                                clearInterval(x);
                                                document.getElementById("counter").innerHTML = "Temps écoulé";
                                            }
                                        }, 1000);
                                    </script>
                                </td>
                            @else
                                <td class="text-center">📵</td>
                            @endif



                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        var encours = {!! json_encode($number_encours) !!};
        if (encours >= 1) {
            
            window.setInterval(function() {

                Livewire.emit('actualiser');
            }, 5000);
        }


        function showMessage(message) {
            swal({
                title: "Message",
                text: message,
                imageUrl: "images/thumbs-up.jpg"
            });

        }
    </script>
</div>
