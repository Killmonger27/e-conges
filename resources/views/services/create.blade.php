<x-adm-layout>
    <div class="main-content container-fluid ">
        <div class="page-title">
            <div class="row ">
                <div class="col-12 col-md-6 order-md-1 order-first">
                    <h3>Creer un nouveau service</h3>
                    <p class="text-subtitle text-muted">Veuillez remplir les champs suivants pour créer un nouveau service</p>
                </div>
            </div>
        </div>
        {{-- <div class="col-12 col-md-6"> --}}
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal" action="{{ route('services.store') }}" method="POST">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Libellé</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="libelle" class="form-control" name="libelle" placeholder="Libellé du service" required>
                                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('libelle')" />
                                        </div>
                                        <div class="col-md-4">
                                            <label>Description</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="description" class="form-control" name="description" placeholder="Description du service" required>
                                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('description')" />
                                        </div>
                                        <div class="col-md-4">
                                            <label>Directeur</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <select id="chef_de_service_id" class="form-control" name="chef_de_service_id" >
                                                <option value={{null}}>Renseigner plus tard</option>
                                                <!-- Exemple d'option statique -->
                                                <option value="1">Ahmad Saugi</option>
                                                <option value="2">Landry Ouarma</option>
                                                <option value="3">Ahmad Saugi</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary mr-1 mb-1">Enregistrer</button>
                                            <a href="{{ route('services.index') }}" > <div class="btn btn-secondary mr-1 mb-1">Retour</div></a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </div>
    {{-- </div> --}}
</x-adm-layout>
