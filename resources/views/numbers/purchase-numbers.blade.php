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
                                    WhatsApp
                                </option>
                                <option value="facebook">
                                    Facebook
                                </option>
                                <option value="tiktok">
                                    TikTok
                                </option>
                                <option value="gmail">
                                    Gmail
                                </option>
                            </select>
                        </div>
                        <button type="button" onclick="submitForm()" class="btn btn-primary text-center"
                            id="submitButton">Commander</button>

                    </div>
                </div>

            </div>
        </div>


        <div class="col-md-6">
            <div class="card mb-4">
                <h6 class="card-header text-center">👁️ Visualiser la commande 👁️</h6>
                <div class="card-body" id="selectedValues" style="display: none;">
                    <div class="selected-values-container">
                        <div class="row">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p><a href="#!" class="text-dark" id="serviceValue"></a></p>
                                    <p class="small text-muted" id="countryValue"></p>
                                </div>

                                <div>
                                    <h4 class="fw-bold text-success">Rated 4.0/5</h4>
                                </div>
                            </div>

                            <hr class="my-0" />
                            <div class="d-flex justify-content-between align-items-center pb-2">
                                <button class="btn btn-danger btn-sm" type="button"
                                    onclick="deleteSelectedValues()">Annuler</button>
                                <button class="btn btn-outline-success btn-sm mt-2" type="button">Confirmer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>








    <script>
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
    </script>
@endsection
