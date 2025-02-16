<x-adm-layout>
    <div class="main-content container-fluid d-flex flex-column align-items-center">
        <!-- Titre de la page -->
        <div class="page-title text-center w-100">
            <div class="row">
                <div class="col-12">
                    <h3>Informations de l'employé</h3>
                    <p class="text-subtitle text-muted">Détails de l'employé sélectionné.</p>
                </div>
            </div>
        </div>

        <!-- Section principale de l'employé -->
        <section class="section w-75">
            <div class="card">
                <div class="card-body">
                    <!-- Informations principales -->
                    <h5 class="card-title text-center">Informations principales de l'employé</h5>
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <p><strong>Nom :</strong> {{ $employe->nom }}</p>
                            <p><strong>Prénom :</strong> {{ $employe->prenom }}</p>
                            <p><strong>Adresse :</strong> {{ $employe->adresse }}</p>
                            <p><strong>Téléphone :</strong> {{ $employe->telephone }}</p>
                            <p><strong>Date de naissance :</strong> {{ \Carbon\Carbon::parse($employe->date_naissance)->format('d/m/Y') }}</p>
                            <p><strong>Lieu de naissance :</strong> {{ $employe->lieu_naissance }}</p>
                            <p><strong>Sexe :</strong> {{ $employe->sexe }}</p>
                            <p><strong>Email :</strong> {{ $employe->email }}</p>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Informations supplémentaires -->
                    <h5 class="card-title text-center">Informations professionnelles de l'employé</h5>
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <p><strong>Date d'embauche :</strong> {{ \Carbon\Carbon::parse($employe->date_embauche)->format('d/m/Y') }}</p>
                            <p><strong>Salaire :</strong> {{ $employe->salaire }}</p>
                            <p><strong>Solde de congés :</strong> {{ $employe->solde_conges }}</p>
                            <p><strong>Fonction :</strong> {{ $employe->fonction? $employe->fonction->intitule : 'Aucune' }}</p>
                            <p><strong>Service :</strong> {{ $employe->service? $employe->service->libelle : 'Aucun' }}</p>
                            <p><strong>Type :</strong> {{ $employe->type }}</p>
                        </div>
                    </div>

                    <!-- Boutons d'action -->
                    <div class="row justify-content-center mt-4">
                        <div class="col-md-8 text-center">
                            @can('gerer_employes')
                                <a href="{{ route('employes.edit', $employe->id) }}" class="btn btn-primary mx-2">Modifier</a>
                            @endcan
                            <a href="{{ route('employes.index') }}" class="btn btn-secondary mx-2">Retour</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-adm-layout>
