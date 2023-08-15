<div>

    @if ($numbers->where('state', 'en cours')->count() >= 1)
        <div class="col-lg-12">
            <div class="alert alert-warning alert-dismissible fade show text-black" role="alert ">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary"> <strong>Important 🚀📢:</strong> </h5>
                            <ul>
                                <li>Les numéros doivent être utilisés conformément aux <a
                                        href="{{ route('privacy-terms') }}" target="_blank">conditions d'utilisation</a>.
                                </li>
                                <li>Vous avez 10 minutes pour utiliser le numéro avant que l'achat ne soit annulé.</li>
                                <li>Aucun remboursement ne sera possible si le numéro est déjà utilisé.</li>
                            </ul>
                        </div>
                    </div>

                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif


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
                                                document.getElementById("counter").innerHTML = "Time out";
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
            });

        }
    </script>
</div>
