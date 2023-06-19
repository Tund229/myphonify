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
                                        {{ $country->name }}
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
                                        <button class="btn btn-outline-success btn-sm mt-2" type="submit">Confirmer</button>
                                    </form>
                                    
                                    
                                </div>

                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>








    {{-- <script>
        function submitForm() {
            var countrySelect = document.getElementById('single-select-optgroup-field');
            var serviceSelect = document.getElementById('serviceSelect');
            var selectedValuesDiv = document.getElementById('selectedValues');
            var submitButton = document.getElementById('submitButton');

            // Vérifier le champ "Choisir le pays"
            if (countrySelect.value === '') {
                countrySelect.style.borderColor = 'red';
            } else {
                countrySelect.style.borderColor = '';
            }

            // Vérifier le champ "Choisir le service"
            if (serviceSelect.value === '') {
                serviceSelect.style.borderColor = 'red';
            } else {
                serviceSelect.style.borderColor = '';
            }

            // Récupérer les valeurs des champs
            var countryValue = countrySelect.value;
            var serviceValue = serviceSelect.value;
            var countryText = countrySelect.options[countrySelect.selectedIndex].text;
            var serviceText = serviceSelect.options[serviceSelect.selectedIndex].text;


            if (countryValue !== '' && serviceValue !== '') {
                // Afficher la div "selectedValues"
                selectedValuesDiv.style.display = 'block';
                // Afficher les valeurs sélectionnées dans la div "selectedValues"
                document.getElementById('countryValue').textContent = countryText;
                document.getElementById('serviceValue').textContent = serviceText;
                // Désactiver le bouton
                submitButton.disabled = true;
            } else {
                // Masquer la div "selectedValues"
                selectedValuesDiv.style.display = 'none';
                // Activer le bouton
                submitButton.disabled = false;
            }

        }

        function deleteSelectedValues() {
            var selectedValuesDiv = document.getElementById('selectedValues');
            var countryValueSpan = document.getElementById('countryValue');
            var serviceValueSpan = document.getElementById('serviceValue');
            var deleteButton = document.getElementById('deleteButton');

            if (selectedValuesDiv.style.display === 'none') {
                // Afficher la div "selectedValues"
                selectedValuesDiv.style.display = 'block';
                // Réinitialiser les valeurs sélectionnées
                countryValueSpan.textContent = '';
                serviceValueSpan.textContent = '';
                // Mettre à jour le texte du bouton
                deleteButton.textContent = 'Supprimer';
            } else {
                // Masquer la div "selectedValues"
                selectedValuesDiv.style.display = 'none';
                // Réinitialiser les valeurs sélectionnées
                countryValueSpan.textContent = '';
                serviceValueSpan.textContent = '';
                submitButton.disabled = false;
                // Mettre à jour le texte du bouton
                deleteButton.textContent = 'Annuler la suppression';
            }
        }
    </script> --}}
@endsection
