@extends('layouts.app')

@section('content')
    <h5 class="fw-bold py-3 mb-4">Faites votre choix &#x1F60A;</h5>
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="defaultFormControlInput" class="form-label">Choisir le pays</label>
                        <select id="single-select-optgroup-field" class="form-select">
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}" @if ($id == $country->id) selected @endif>

                                    {{ $country->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <div class="mb-3">
                            <label for="serviceSelect" class="form-label">Choisir le service</label>
                            <select id="serviceSelect" class="form-select">
                                <option value="" selected disabled>Sélectionnez un service</option>
                                <option value="whatsapp">
                                    <i class="fab fa-whatsapp"></i> WhatsApp
                                </option>
                                <option value="facebook">
                                    <i class="fab fa-facebook"></i> Facebook
                                </option>
                                <option value="tiktok">
                                    <i class="fab fa-tiktok"></i> TikTok
                                </option>
                                <option value="gmail">
                                    <i class="fab fa-google"></i> Gmail
                                </option>
                            </select>
                        </div>
                        <button type="button" onclick="submitForm()" class="btn btn-primary text-center">Commander</button>

                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-6" >
            <div class="card mb-4" id="selectedValues" style="display: none;">
                <h5 class="card-header">Selected Values</h5>
                <div class="card-body">
                    No values selected.
                </div>
            </div>
        </div>


    </div>

    <script>
        function submitForm() {
            var countrySelect = document.getElementById('single-select-optgroup-field');
            var serviceSelect = document.getElementById('serviceSelect');
            var selectedValuesDiv = document.getElementById('selectedValues');

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
                selectedValuesDiv.innerHTML = 'Pays sélectionné: ' + countryText + ' (ID: ' + countryValue + ')<br>' +
                    'Service sélectionné: ' + serviceText + ' (Valeur: ' + serviceValue + ')';
            } else {
                // Masquer la div "selectedValues"
                selectedValuesDiv.style.display = 'none';
            }
        }
    </script>
@endsection
