<x-adm-layout>
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-first">
                    <h3>Informations de l'employé</h3>
                    <p class="text-subtitle text-muted">Détails de l'employé sélectionné.</p>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label>Nom</label>
                        <p class="form-control-plaintext">{{ $employe->nom }}</p>
                    </div>
                    <div class="form-group">
                        <label>Prénom</label>
                        <p class="form-control-plaintext">{{ $employe->prenom }}</p>
                    </div>
                    <div class="form-group">
                        <label>Adresse</label>
                        <p class="form-control-plaintext">{{ $employe->adresse }}</p>
                    </div>
                    <div class="form-group">
                        <label>Téléphone</label>
                        <p class="form-control-plaintext">{{ $employe->telephone }}</p>
                    </div>
                    <div class="form-group">
                        <label>Date de naissance</label>
                        <p class="form-control-plaintext">{{ $employe->date_naissance }}</p>
                    </div>
                    <div class="form-group">
                        <label>Lieu de naissance</label>
                        <p class="form-control-plaintext">{{ $employe->lieu_naissance }}</p>
                    </div>
                    <div class="form-group">
                        <label>Sexe</label>
                        <p class="form-control-plaintext">{{ $employe->sexe }}</p>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <p class="form-control-plaintext">{{ $employe->email }}</p>
                    </div>
                    <div class="form-group">
                        <label>Date d'embauche</label>
                        <p class="form-control-plaintext">{{ $employe->date_embauche }}</p>
                    </div>
                    <div class="form-group">
                        <label>Salaire</label>
                        <p class="form-control-plaintext">{{ $employe->salaire }}</p>
                    </div>
                    <div class="form-group">
                        <label>Solde de congés</label>
                        <p class="form-control-plaintext">{{ $employe->solde_conges }}</p>
                    </div>
                    <div class="form-group">
                        <label>Fonction</label>
                        <p class="form-control-plaintext">{{ $employe->fonction? $employe->fonction->intitule : 'Aucune' }}</p>
                    </div>
                    <div class="form-group">
                        <label>Service</label>
                        <p class="form-control-plaintext">{{ $employe->service? $employe->service->libelle : 'Aucun' }}</p>
                    </div>
                    <div class="form-group">
                        <label>Type</label>
                        <p class="form-control-plaintext">{{ $employe->type }}</p>
                    </div>
                    <div class="col-sm-12 d-flex justify-content-end">
                        <a href="{{ route('employes.edit', $employe->id) }}" class="btn btn-primary mr-1 mb-1">Modifier</a>
                        <a href="{{ route('employes.index') }}" class="btn btn-secondary mr-1 mb-1">Retour</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-adm-layout>