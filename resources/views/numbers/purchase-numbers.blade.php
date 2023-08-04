@extends('layouts.app')

@section('content')
    @if (session()->has('error_message'))
        <div class="alert alert-danger mt-4 d-flex justify-content-center" role="alert"
            style="background-color: #e94c4c; color: #FFFFFF;">
            {{ session('error_message') }}
        </div>
    @endif
    <h5 class="fw-bold py-3 mb-2">Faites votre choix &#x1F60A;</h5>


    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{ route('temp-purchase') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="defaultFormControlInput" class="form-label">Choisir le pays</label>
                            <select id="single-select-optgroup-field" class="form-select" name="country_id">
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}" @if ($id == $country->phonecode) selected @endif>
                                        <div class="d-flex justify-content-between">
                                            <span>{{ $country->name }}</span>
                                            <span class="text-end">(+{{ $country->phonecode }})</span>
                                        </div>
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <div class="mb-3">
                                <label for="serviceSelect" class="form-label">Choisir le service</label>
                                <select id="serviceSelect" class="form-select" name="service">
                                    <option value="" selected disabled>Sélectionnez un service</option>
                                    <option value="whatsapp">
                                        WhatsApp
                                    </option>
                                    <option value="facebook">
                                        Facebook
                                    </option>
                                    <option value="TikTok">
                                        TikTok
                                    </option>
                                    <option value="gmail">
                                        Gmail
                                    </option>
                                </select>

                                <div class="mt-3">
                                    @error('service')
                                        <span class="text-danger text-center mb-4" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary text-center">Commander</button>

                        </div>
                    </form>

                </div>

            </div>
        </div>


        <div class="col-md-6">
            <div class="card mb-4">
                <h6 class="card-header text-center">👁️ Visualiser la commande 👁️</h6>
                <div class="card-body">
                    @foreach ($temppurchase as $purchase)
                        <div class="selected-values-container">
                            <hr class="my-0" />
                            <div class="row">
                                <div class="d-flex justify-content-between mt-2">
                                    <div>
                                        <p class="text-dark">{{ strtoupper($purchase->service) }}</p>
                                        <p class="small text-muted"> {{ $purchase->country->name }} ( +
                                            {{ $purchase->country->phonecode }})</p>
                                    </div>

                                    <div>
                                        <h4 class="fw-bold text-success">{{ $purchase->service_price }} XOF</h4>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center pb-2">
                                    <a href="{{ route('purchase-delete', ['id' => $purchase->id]) }}">
                                        <button class="btn btn-danger btn-sm" type="button">Annuler</button>
                                    </a>

                                    <form action="{{ route('purchase', ['id' => $purchase->id]) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-outline-success btn-sm mt-2"
                                            type="submit">Confirmer</button>
                                    </form>


                                </div>

                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>


@endsection
