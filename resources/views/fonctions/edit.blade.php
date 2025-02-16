<x-adm-layout>
    <div class="main-content container-fluid d-flex flex-column align-items-center">
        <!-- Titre de la page -->
        <div class="page-title text-center w-100">
            <div class="row">
                <div class="col-12">
                    <h3>Modifier la fonction</h3>
                    <p class="text-subtitle text-muted">Modifiez les informations de cette fonction.</p>
                </div>
            </div>
        </div>

        <!-- Section du formulaire -->
        <section class="section w-75">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('fonctions.update', $fonction->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Informations de la fonction -->
                        <h5 class="card-title text-center">Informations de la fonction</h5>
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="intitule">Intitulé</label>
                                    <input type="text" id="intitule" class="form-control" name="intitule"
                                           value="{{ old('intitule', $fonction->intitule) }}"
                                           placeholder="Intitulé de la fonction" required>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('intitule')" />
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" id="description" class="form-control" name="description"
                                           value="{{ old('description', $fonction->description) }}"
                                           placeholder="Description de la fonction">
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('description')" />
                                </div>
                            </div>
                        </div>

                        <!-- Boutons d'action -->
                        <div class="row justify-content-center mt-4">
                            <div class="col-md-8 text-center">
                                <button type="submit" class="btn btn-primary mx-2">Enregistrer les modifications</button>
                                <a href="{{ route('fonctions.index') }}" class="btn btn-secondary mx-2">Retour</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</x-adm-layout>
