<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up - Voler Admin Dashboard</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/app.css">
</head>

<body>
    <div id="auth">
        
<div class="container">
    <div class="row">
        <div class="col-md-7 col-sm-12 mx-auto">
            <div class="card pt-3">
                <div class="card-body">
                    <div class="text-center mb-3">
                        <img src="assets/images/favicon.svg" height="48" class='mb-3'>
                        <h3>Sign Up</h3>
                        <p>Please fill the form to register.</p>
                    </div>
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="nom">Nom</label>
                                    <input type="text" id="nom" class="form-control"  name="nom" required>
                                    <x-input-error class="mt-2 bg-danger" :messages="$errors->get('nom')" />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="prenom">Prenom</label>
                                    <input type="text" id="prenom" class="form-control"  name="prenom" required>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('prenom')" />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="adresse">Adresse</label>
                                    <input type="text" id="adresse" class="form-control" name="adresse" required>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('adresse')" />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="telephone">Telephone</label>
                                    <input type="text" id="telephone" class="form-control" name="telephone" required>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('telephone')" />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="date_naissance">Date de naissance</label>
                                    <input type="date" id="date_naissance" class="form-control" name="date_naissance" required>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('date_naissance')" />
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="lieu_naissance">Lieu de naissance</label>
                                    <input type="text" id="lieu_naissance" class="form-control" name="lieu_naissance" required>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('lieu_naissance')" />
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="sexe">Sexe</label>
                                    <select id="sexe" class="form-control" name="sexe" required>
                                        <option value="">Sélectionnez un sexe</option>
                                        <option value="homme">Homme</option>
                                        <option value="femme">Femme</option>
                                    </select>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('sexe')" />
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="date_embauche">Date d'embauche</label>
                                    <input type="date" id="date_embauche" class="form-control" name="date_embauche" required>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('date_embauche')" />
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="salaire">Salaire</label>
                                    <input type="number" id="salaire" class="form-control" name="salaire" min="0" step="0.01" required>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('salaire')" />
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="solde_conges">Solde Conges</label>
                                    <input type="number" id="solde_conges" class="form-control" name="solde_conges" min="0" step="1" required> 
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('solde_conges')" />
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="fonction_id">Fonction</label>
                                    <select id="fonction_id" class="form-control" name="fonction_id" required>
                                        <option value="">Sélectionnez une fonction</option>
                                        <!-- Exemple d'option statique -->
                                        <option value="1">Developpeur</option>
                                        <option value="2">Testeur</option>
                                        <option value="3">Designer</option>
                                    </select>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('fonction_id')" />
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="service_id">Service</label>
                                    <select id="service_id" class="form-control" name="service_id" >
                                        <option value="">Sélectionnez un service</option>
                                        <!-- Exemple d'option statique -->
                                        <option value="1">Bibliothèque</option>
                                        <option value="2">Secretariat</option>
                                        <option value="3">Informatique</option>
                                        <option value="4">Communication</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="type">Role</label>
                                    <select id="type" class="form-control" name="type" required>
                                        <option value="">Sélectionnez un rôle</option>
                                        <!-- Exemple d'option statique -->
                                        <option value="employe">Employe</option>
                                        <option value="grh">Gestionnaire de ressources humaines</option>
                                        <option value="chef de service">Chef de service</option>
                                        <option value="Directeur">Directeur</option>
                                    </select>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('type')" />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" class="form-control" name="email" required>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('email')" />
                                </div>
                            </div>
                        
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="password">Mot de passe</label>
                                    <input type="password" id="password" class="form-control" name="password" required>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('password')" />
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="password_confirmation">Confirmer le mot de passe</label>
                                    <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" required>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('password_confirmation')" />
                                </div>
                            </div>

                        </div>

                        <a href="/login">Page de login</a>
                        <div class="clearfix">
                            <button class="btn btn-primary float-right">S'inscrire</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>

    </div>
    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/js/app.js"></script>
    
    <script src="assets/js/main.js"></script>
</body>

</html>