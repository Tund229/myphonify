@extends('layouts.app')

@section('content')
    @if (session()->has('status'))
        <div class="alert alert-danger mt-4 d-flex justify-content-center" role="alert"
            style="background-color: green; color: #FFFFFF;">
            {{ session('status') }}
        </div>
    @endif


    <div class="card mb-4 ">
        <div class="row justify-content-center gap-3">
            <div class="col-3">
                <h5 class="card-header"> <span class="badge rounded-pill bg-label-primary px-4">{{ $country->name }}</span>
                </h5>
            </div>

            <div class="col-3">
                <h5 class="card-header">
                    @if ($country->state == true)
                        <a href="{{ route('private.updateState', collect(request()->segments())->last()) }}">
                            <span class="badge rounded-pill bg-label-success px-4">Actif</span>
                        </a>
                    @elseif($country->state == false)
                        <a href="{{ route('private.updateState', collect(request()->segments())->last()) }}">

                            <span class="badge rounded-pill bg-label-danger px-4">Inactif</span>
                        </a>
                    @endif
                </h5>
            </div>

            <div class="col-3">
                <h5 class="card-header">
                    @if ($country->Mta == true)
                        <a href="{{ route('private.updateMta', collect(request()->segments())->last()) }}">
                            <span class="badge rounded-pill bg-label-success px-4">MTA : Autorisé</span>
                        </a>
                    @elseif($country->Mta == false)
                        <a href="{{ route('private.updateMta', collect(request()->segments())->last()) }}">
                            <span class="badge rounded-pill bg-label-danger px-4">MTA :Refusé</span>
                        </a>
                    @endif
                </h5>
            </div>

        </div>



        <!-- Account -->
        <hr class="my-0" />
        <div class="card-body">
            <form id="formAccountSettings" {{ route('private.countries.update', collect(request()->segments())->last()) }}"
                method="POST">
                @csrf
                @method('put')
                <div class="row">

                    <div class="mb-3 col-md-6">
                        <label for="lastName" class="form-label">Id whatsapp</label>
                        <input class="form-control" name="id_whatsapp" type="number"
                            value="{{ $country->id_whatsapp ?? null }}" />
                        <div>
                            @error('id_whatsapp')
                                <span role="alert" class="text-danger text-center">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="email" class="form-label">Id facebook</label>
                        <input class="form-control" name="id_facebook" type="number"
                            value="{{ $country->id_facebook ?? null }}" />
                        <div>
                            @error('id_facebook')
                                <span role="alert" class="text-danger text-center">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="organization" class="form-label">Id Gmail</label>
                        <input type="number" name="id_gmail" class="form-control"
                            value="{{ $country->id_gmail ?? null }}" />
                        <div>
                            @error('id_gmail')
                                <span role="alert" class="text-danger text-center">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="organization" class="form-label">Id Télegram</label>
                        <input type="number" name="id_telegram" class="form-control"
                            value="{{ $country->id_telegram ?? null }}" />
                        <div>
                            @error('id_telegram')
                                <span role="alert" class="text-danger text-center">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="organization" class="form-label">Prix whatsapp</label>
                        <input type="number" name="price_whatsapp" class="form-control"
                            value="{{ $country->price_whatsapp }}" />
                        <div>
                            @error('price_whatsapp')
                                <span role="alert" class="text-danger text-center">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="organization" class="form-label">Prix Télégram</label>
                        <input type="number" name="price_telegram" class="form-control"
                            value="{{ $country->price_telegram }}" />
                        <div>
                            @error('price_telegram')
                                <span role="alert" class="text-danger text-center">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="organization" class="form-label">Prix Facebook</label>
                        <input type="number" name="price_facebook" class="form-control"
                            value="{{ $country->price_facebook }}" />
                        <div>
                            @error('price_facebook')
                                <span role="alert" class="text-danger text-center">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="organization" class="form-label">Prix Gmail</label>
                        <input type="number" name="price_gmail" class="form-control"
                            value="{{ $country->price_gmail }}" />
                        <div>
                            @error('price_gmail')
                                <span role="alert" class="text-danger text-center">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="organization" class="form-label">Prix Tiktok</label>
                        <input type="number" name="price_TikTok" class="form-control"
                            value="{{ $country->price_TikTok }}" />
                        <div>
                            @error('price_TikTok')
                                <span role="alert" class="text-danger text-center">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="organization" class="form-label">Prix Viber</label>
                        <input type="number" name="price_Viber" class="form-control"
                            value="{{ $country->price_Viber }}" />
                        <div>
                            @error('price_viber')
                                <span role="alert" class="text-danger text-center">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="organization" class="form-label">Prix Signal</label>
                        <input type="number" name="price_Signal" class="form-control"
                            value="{{ $country->price_Signal }}" />
                        <div>
                            @error('price_signal')
                                <span role="alert" class="text-danger text-center">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="api" class="form-label">Api</label>

                        <select name="api_id" id="api" class="form-control">
                            @foreach ($apis as $api)
                                <option value="{{ $api->id }}" @if ($api->id == $country->api_id) selected @endif">
                                    {{ $api->name }}
                                </option>
                            @endforeach
                        </select>

                    </div>

                    <div class="mb-3 col-md-6">
                        <button type="submit" class="btn btn-sm btn-outline-primary">Modifier</button>
                    </div>

                </div>
            </form>
        </div>
        <!-- /Account -->
    </div>
@endsection
