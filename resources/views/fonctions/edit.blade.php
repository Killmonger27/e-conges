<x-adm-layout>
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-first">
                    <h3>Modifier la fonction</h3>
                    <p class="text-subtitle text-muted">Modifiez les informations de cette fonction.</p>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <form class="form form-horizontal" action="{{ route('fonctions.update', $fonction->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="intitule">Intitulé</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="text" id="intitule" class="form-control" name="intitule"
                                           value="{{ old('intitule', $fonction->intitule) }}"
                                           placeholder="Intitulé de la fonction" required>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('intitule')" />
                                </div>
                                <div class="col-md-4">
                                    <label for="description">Description</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="text" id="description" class="form-control" name="description"
                                           value="{{ old('description', $fonction->description) }}"
                                           placeholder="Description de la fonction">
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('description')" />
                                </div>
                                <div class="col-sm-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary mr-1 mb-1">Enregistrer les modifications</button>
                                    <a href="{{ route('fonctions.index') }}">
                                        <div class="btn btn-secondary mr-1 mb-1">Retour</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</x-adm-layout>