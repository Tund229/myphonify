@extends('layouts.app')

@section('content')

    <h5 class="card-header ">Numéros</h5>

    <div class="card py-4">
        <div class="table-responsive ">
            <table class="table table-striped" id="dataTable">
                <thead>
                    <tr class="text-nowrap">
                        <th class="text-center">Date</th>
                        <th class="text-center">Service</th>
                        <th class="text-center">Pays</th>
                        <th class="text-center">Utilisateur</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Message</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($numbers as $number)
                        <tr>
                            <td class="text-center">{{ $number->created_at }}</td>
                            <td class="text-center">{{ $number->service }}</td>
                            <td class="text-center">{{ $number->country_name }}</td>
                            <td class="text-center">{{ $number->user->name }}</td>
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
                                    <span style="cursor: pointer;" onclick="showMessage('{{ $number->message }}')">💬</span>
                                @endif
                            </td>

                            <td class="text-center">
                                <a href="{{route('private.numbers.show', $number->id)}}">
                                    <button class="btn btn-outline-primary">
                                        Détails </button>
                                </a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function showMessage(message) {
            console.log(message);
            swal({
                title: "Message",
                text: message,
                imageUrl: "images/thumbs-up.jpg"
            });

        }
    </script>
@endsection
