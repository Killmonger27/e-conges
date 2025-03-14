<x-adm-layout>
    <div class="main-content container-fluid d-flex flex-column align-items-center">
        <div class="page-title text-center w-100">
            <div class="row">
                <div class="col-12">
                    <h3>Créer un nouveau service</h3>
                    <p class="text-subtitle text-muted">Veuillez remplir les champs suivants pour créer un nouveau
                        service</p>
                </div>
            </div>
        </div>

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
                    <form action="{{ route('services.store') }}" method="POST">
                        @csrf

                        <h5 class="card-title text-center">Informations du service</h5>
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="libelle">Libellé</label>
                                    <input type="text" id="libelle" class="form-control" name="libelle"
                                        placeholder="Libellé du service" required>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('libelle')" />
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" id="description" class="form-control" name="description"
                                        placeholder="Description du service" required>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('description')" />
                                </div>
                                <div class="form-group">
                                    <label for="chef_de_service_id">Chef de service</label>
                                    <select id="chef_de_service_id" class="form-control" name="chef_de_service_id">
                                        <option value="{{ null }}">Renseigner plus tard</option>
                                        <!-- Exemple d'option statique -->
                                        <option value="1">Ahmad Saugi</option>
                                        <option value="2">Landry Ouarma</option>
                                        <option value="3">Ahmad Saugi</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center mt-4">
                            <div class="col-md-8 text-center">
                                <button type="submit" class="btn btn-primary mx-2">Enregistrer</button>
                                <a href="{{ route('services.index') }}" class="btn btn-secondary mx-2">Retour</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</x-adm-layout>
