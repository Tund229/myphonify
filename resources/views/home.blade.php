@extends('layouts.app')

@section('content')

    <h5 class="card-header ">Pays disponibles</h5>
    <div class="card py-4">
        <div class="table-responsive ">
            <table class="table table-striped" id="dataTable">
                <thead>
                    <tr class="text-nowrap">
                        <th class="text-center">Pays</th>
                        <th class="text-center">Acheter</th>
                        <th class="text-center">WhatsApp</th>
                        <th class="text-center">Facebook</th>
                        <th class="text-center">Gmail</th>
                        <th class="text-center">TikTok</th>
                        <th class="text-center">Telegram</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($countries as $country)
                        <tr>
                            <td class="text-center">{{ $country->name }}</td>
                            <td class="text-center">
                                <a href="{{ route('purchase-numbers', ['id' => $country->phonecode]) }}">
                                    <button class="btn btn-outline-primary">
                                        <i class="bx bx-cart"></i>
                                    </button>
                                </a>
                            </td>
                            <td class="text-center">{{ $country->price_whatsapp }}</td>
                            <td class="text-center">{{ $country->price_facebook }}</td>
                            <td class="text-center">{{ $country->price_gmail }}</td>
                            <td class="text-center">{{ $country->price_TikTok }}</td>
                            <td class="text-center">{{ $country->price_telegram }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
