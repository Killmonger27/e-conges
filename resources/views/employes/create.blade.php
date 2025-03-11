<x-adm-layout>
    <div class="main-content container-fluid d-flex flex-column align-items-center">
        <!-- Titre de la page -->
        <div class="page-title text-center w-100">
            <div class="row">
                <div class="col-12">
                    <h3>Créer un employé</h3>
                    <p class="text-subtitle text-muted">Remplissez le formulaire ci - dessous pour créer un nouvel
                        employé.</p>
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
                    <form action="{{ route('employes.store') }}" method="POST">
                        @csrf

                        <!-- Informations personnelles -->
                        <h5 class="card-title text-center">Informations personnelles</h5>
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="nom">Nom</label>
                                    <input type="text" class="form-control" id="nom" name="nom"
                                        placeholder="Nom de l'employé" required>
                                </div>
                                <div class="form-group">
                                    <label for="prenom">Prénom</label>
                                    <input type="text" class="form-control" id="prenom" name="prenom"
                                        placeholder="Prénom de l'employé" required>
                                </div>
                                <div class="form-group">
                                    <label for="adresse">Adresse</label>
                                    <input type="text" class="form-control" id="adresse" name="adresse"
                                        placeholder="Adresse de l'employé" required>
                                </div>
                                <div class="form-group">
                                    <label for="telephone">Téléphone</label>
                                    <input type="text" class="form-control" id="telephone" name="telephone"
                                        placeholder="Numéro de téléphone de l'employé" required>
                                </div>
                                <div class="form-group">
                                    <label for="date_naissance">Date de naissance</label>
                                    <input type="date" class="form-control" id="date_naissance" name="date_naissance"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="lieu_naissance">Lieu de naissance</label>
                                    <input type="text" class="form-control" id="lieu_naissance" name="lieu_naissance"
                                        placeholder="Lieu de naissance de l'employé" required>
                                </div>
                                <div class="form-group">
                                    <label for="sexe">Sexe</label>
                                    <select class="form-control" id="sexe" name="sexe" required>
                                        <option value="homme">Homme</option>
                                        <option value="femme">Femme</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Email de l'employé" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Mot de passe</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Mot de passe de l'employé" required>
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Confirmer le mot de passe</label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation" placeholder="Confirmez le mot de passe" required>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Informations professionnelles -->
                        <h5 class="card-title text-center">Informations professionnelles</h5>
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="date_embauche">Date d'embauche</label>
                                    <input type="date" class="form-control" id="date_embauche" name="date_embauche"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="salaire">Salaire</label>
                                    <input type="number" class="form-control" id="salaire" name="salaire"
                                        placeholder="Salaire de l'employé" required>
                                </div>
                                <div class="form-group">
                                    <label for="solde_conges">Solde de congés</label>
                                    <input type="number" class="form-control" id="solde_conges" name="solde_conges"
                                        placeholder="Solde de congés de l'employé" required>
                                </div>
                                <div class="form-group">
                                    <label for="fonction_id">Fonction</label>
                                    <select class="form-control" id="fonction_id" name="fonction_id">
                                        <option value="">Aucune</option>
                                        @foreach ($fonctions as $fonction)
                                            <option value="{{ $fonction->id }}">{{ $fonction->intitule }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="service_id">Service</label>
                                    <select class="form-control" id="service_id" name="service_id">
                                        <option value="">Aucun</option>
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}">{{ $service->libelle }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <select class="form-control" id="type" name="type" required>
                                        <option value="employe">Employé</option>
                                        <option value="chef de service">Chef de service</option>
                                        <option value="grh">GRH</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Boutons d'action -->
                        <div class="row justify-content-center mt-4">
                            <div class="col-md-8 text-center">
                                <button type="submit" class="btn btn-primary mx-2">Enregistrer l'employé</button>
                                <a href="{{ route('employes.index') }}" class="btn btn-secondary mx-2">Retour</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</x-adm-layout>
