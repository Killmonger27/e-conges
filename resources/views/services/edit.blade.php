<x-adm-layout>
    <div class="main-content container-fluid d-flex flex-column align-items-center">
        <!-- Titre de la page -->
        <div class="page-title text-center w-100">
            <div class="row">
                <div class="col-12">
                    <h3>Modifier le service</h3>
                    <p class="text-subtitle text-muted">Modifiez les informations de ce service.</p>
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
                    <form action="{{ route('services.update', $service->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Informations du service -->
                        <h5 class="card-title text-center">Informations du service</h5>
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="libelle">Libellé</label>
                                    <input type="text" class="form-control" id="libelle" name="libelle" value="{{ $service->libelle }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description">{{ $service->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="chef_service_id">Directeur</label>
                                    <select class="form-control" id="chef_de_service_id" name="chef_de_service_id">
                                        <option value="">Aucun</option>
                                        @foreach($chefs as $utilisateur)
                                            <option value="{{ $utilisateur->id }}" {{ $service->chef_service_id == $utilisateur->id ? 'selected' : '' }}>
                                                {{ $utilisateur->prenom }} {{ $utilisateur->nom }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Boutons d'action -->
                        <div class="row justify-content-center mt-4">
                            <div class="col-md-8 text-center">
                                <button type="submit" class="btn btn-primary mx-2">Enregistrer les modifications</button>
                                <a href="{{ route('services.index') }}" class="btn btn-secondary mx-2">Retour</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</x-adm-layout>
