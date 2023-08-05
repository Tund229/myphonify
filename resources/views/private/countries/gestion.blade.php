@extends('layouts.app')

@section('content')

@if (session()->has('status'))
<div class="alert alert-danger mt-4 d-flex justify-content-center" role="alert"
    style="background-color: green; color: #FFFFFF;">
    {{ session('status') }}
</div>
@endif

<h5 class="card-header">Gestion rapides des pays</h5>

    <form action="{{route('private.gestion_pays')}}" method="post">
    @csrf
        <div class="row">
            <div class="col-12 col-sm-4 mb-3">
                <select name="countries[]" id="" multiple class="form-control" style="height: 300px">
                    @foreach ($countries as $country)
                        <option value="{{ $country->id }}" class="py-1">{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-sm-4 mb-3">
                <select name="services[]" id="" multiple class="form-control" style="height: 300px">
                    <option value="price_whatsapp" class="py-1">Whatsapp</option>
                    <option value="price_telegram" class="py-1">Telegram</option>
                    <option value="price_facebook" class="py-1">Facebook</option>
                    <option value="price_gmail" class="py-1">Google</option>
                    <option value="price_TikTok" class="py-1">Tiktok</option>
                    <option value="price_Viber" class="py-1">Viber</option>
                    <option value="price_Signal" class="py-1">Signal</option>
                </select>
            </div>
            <div class="col-12 col-sm-4 mb-3">
                <div class="mb-2">
                    <input type="number" name="price" id="" class="form-control" placeholder="Prix">
                </div>
                <select name="apis" class="form-control">
                    @foreach ($apis as $api)
                        <option value="{{ $api->id }}">{{ $api->name }}</option>
                    @endforeach
                </select>
                <button class="form-control btn btn-primary mt-2">Enregistrer</button>
            </div>
        </div>
    </form>
@endsection
