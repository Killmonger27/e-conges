<x-adm-layout>
    <div class="main-content container-fluid ">
        <div class="page-title">
            <div class="row ">
                <div class="col-12 col-md-6 order-md-1 order-first">
                    <h3>Ajouter une nouvelle fonction</h3>
                    <p class="text-subtitle text-muted">Veuillez remplir les champs suivants pour ajouter une nouvelle fonction</p>
                </div>
            </div>
        </div>
        {{-- <div class="col-12 col-md-6"> --}}
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal" action="{{ route('fonctions.store') }}" method="POST">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Intitule</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="intitule" class="form-control" name="intitule" placeholder="Intitule de la fonction" required>
                                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('intitule')" />
                                        </div>
                                        <div class="col-md-4">
                                            <label>Description</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="description" class="form-control" name="description" placeholder="Description de la fonction" required>
                                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('description')" />
                                        </div>
                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary mr-1 mb-1">Enregistrer</button>
                                            <a href="{{ route('fonctions.index') }}" > <div class="btn btn-secondary mr-1 mb-1">Retour</div></a>
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
