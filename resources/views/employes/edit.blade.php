<x-adm-layout>
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-first">
                    <h3>Modifier les informations de l'employé</h3>
                    <p class="text-subtitle text-muted">Mettez à jour les informations de l'employé ci - dessous.</p>
                </div>
            </div>
        </div>
        <section class="section">
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
                    <form action="{{ route('employes.update', $employe->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nom">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom', $employe->nom) }}" placeholder="Nom de l'employé" required>
                        </div>
                        <div class="form-group">
                            <label for="prenom">Prénom</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" value="{{ old('prenom', $employe->prenom) }}" placeholder="Prénom de l'employé" required>
                        </div>
                        <div class="form-group">
                            <label for="adresse">Adresse</label>
                            <input type="text" class="form-control" id="adresse" name="adresse" value="{{ old('adresse', $employe->adresse) }}" placeholder="Adresse de l'employé" required>
                        </div>
                        <div class="form-group">
                            <label for="telephone">Téléphone</label>
                            <input type="text" class="form-control" id="telephone" name="telephone" value="{{ old('telephone', $employe->telephone) }}" placeholder="Numéro de téléphone de l'employé" required>
                        </div>
                        <div class="form-group">
                            <label for="date_naissance">Date de naissance</label>
                            <input type="date" class="form-control" id="date_naissance" name="date_naissance" value="{{ old('date_naissance', $employe->date_naissance) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="lieu_naissance">Lieu de naissance</label>
                            <input type="text" class="form-control" id="lieu_naissance" name="lieu_naissance" value="{{ old('lieu_naissance', $employe->lieu_naissance) }}" placeholder="Lieu de naissance de l'employé" required>
                        </div>
                        <div class="form-group">
                            <label for="sexe">Sexe</label>
                            <select class="form-control" id="sexe" name="sexe" required>
                                <option value="homme" {{ old('sexe', $employe->sexe) === 'homme'? 'selected' : '' }}>Homme</option>
                                <option value="femme" {{ old('sexe', $employe->sexe) === 'femme'? 'selected' : '' }}>Femme</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $employe->email) }}" placeholder="Email de l'employé" required>
                        </div>
                        <div class="form-group">
                            <label for="date_embauche">Date d'embauche</label>
                            <input type="date" class="form-control" id="date_embauche" name="date_embauche" value="{{ old('date_embauche', $employe->date_embauche) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="salaire">Salaire</label>
                            <input type="number" class="form-control" id="salaire" name="salaire" value="{{ old('salaire', $employe->salaire) }}" placeholder="Salaire de l'employé" required>
                        </div>
                        <div class="form-group">
                            <label for="solde_conges">Solde de congés</label>
                            <input type="number" class="form-control" id="solde_conges" name="solde_conges" value="{{ old('solde_conges', $employe->solde_conges) }}" placeholder="Solde de congés de l'employé" required>
                        </div>
                        <div class="form-group">
                            <label for="fonction_id">Fonction</label>
                            <select class="form-control" id="fonction_id" name="fonction_id">
                                <option value="">Aucune</option>
                                @foreach ($fonctions as $fonction)
                                    <option value="{{ $fonction->id }}" {{ old('fonction_id', $employe->fonction_id) == $fonction->id? 'selected' : '' }}>{{ $fonction->intitule }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="service_id">Service</label>
                            <select class="form-control" id="service_id" name="service_id">
                                <option value="">Aucun</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}" {{ old('service_id', $employe->service_id) == $service->id? 'selected' : '' }}>{{ $service->libelle }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="type">Type</label>
                            <select class="form-control" id="type" name="type" required>
                                <option value="employe" {{ old('type', $employe->type) === 'employe'? 'selected' : '' }}>Employé</option>
                                <option value="chef de service" {{ old('type', $employe->type) === 'chef de service'? 'selected' : '' }}>Chef de service</option>
                                <option value="grh" {{ old('type', $employe->type) === 'grh'? 'selected' : '' }}>GRH</option>
                                <option value="directeur" {{ old('type', $employe->type) === 'directeur'? 'selected' : '' }}>Directeur</option>
                            </select>
                        </div>
                        <div class="col-sm-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mr-1 mb-1">Enregistrer les modifications</button>
                            <a href="{{ route('employes.show', $employe->id) }}" class="btn btn-secondary mr-1 mb-1">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</x-adm-layout>