<x-adm-layout>
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row ">
                <div class="col-12 col-md-6 order-md-1 order-first">
                    <h3>Modifier le service</h3>
                    <p class="text-subtitle text-muted">Modifiez les informations de ce service.</p>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('services.update', $service->id) }}" method="POST">
                        @csrf
                        @method('PUT')
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
                            <select class="form-control" id="chef_service_id" name="chef_service_id">
                                <option value="">Aucun</option>
                                @foreach(\App\Models\User::all() as $utilisateur)
                                    <option value="{{ $utilisateur->id }}" {{ $service->chef_service_id == $utilisateur->id ? 'selected' : '' }}>
                                        {{ $utilisateur->prenom }} {{ $utilisateur->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</x-adm-layout>