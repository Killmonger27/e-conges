<x-adm-layout>
    <div class="main-content container-fluid">
        <div class="page-title text-center">
            <div class="row">
                <div class="col-12">
                    <h3>Détails de la demande</h3>
                    <p class="text-subtitle text-muted">Consultez toutes les informations relatives à cette demande et prenez une décision si nécessaire.</p>
                </div>
            </div>
        </div>

        <section class="section d-flex justify-content-center">
            <div class="card w-75">
                <div class="card-body">
                    <h5 class="card-title text-center">Informations principales de la demande</h5>
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <p><strong>Demandeur :</strong> {{ $demande->employe->nom ?? 'Non défini' }} {{ $demande->employe->prenom ?? 'Non défini' }}</p>
                            <p><strong>Type de demande :</strong> <span class="badge bg-primary">{{ ucfirst($demande->type_de_demande) }}</span></p>
                            <p><strong>Motif :</strong> {{ $demande->motif }}</p>
                            <p><strong>Date de demande :</strong> {{ \Carbon\Carbon::parse($demande->date_de_demande)->format('d/m/Y') }}</p>
                            <p><strong>Période :</strong> {{ \Carbon\Carbon::parse($demande->date_de_debut)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($demande->date_de_fin)->format('d/m/Y') }}</p>
                            <p><strong>Statut :</strong> 
                                @if ($demande->status === 'accorde')
                                    <span class="badge bg-success">Accordée</span>
                                @elseif ($demande->status === 'rejete')
                                    <span class="badge bg-danger">Rejetée</span>
                                @else
                                    <span class="badge bg-secondary">En cours</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <hr class="my-4">
                    <h5 class="card-title text-center">Informations supplémentaires</h5>
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <p><strong>Téléphone de l'employé :</strong> {{ $demande->employe->telephone ?? 'Non défini' }}</p>
                            <p><strong>Adresse de l'employé :</strong> {{ $demande->employe->adresse ?? 'Non défini' }}</p>
                            <p><strong>Libellé du service :</strong> {{ $demande->service->libelle ?? 'Non défini' }}</p>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-4">
                        <div class="col-md-8 text-center">
                            <a href="{{ route('demandes.index') }}" class="btn btn-primary">Retour</a>
                            @if ($demande->status === 'encours' && auth()->user()->type === 'grh')
                                <a href="{{ route('grh.edit', $demande->id) }}" class="btn btn-info mx-2">Modifier</a>
                            @endif
                            @if ($demande->status === 'encours' && in_array(auth()->user()->type, ['directeur', 'chef de service', 'grh']))
                                <form action="{{ route('demandes.approve', $demande) }}" method="post" class="d-inline mx-2">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Approuver</button>
                                </form>
                                <form action="{{ route('demandes.reject', $demande) }}" method="post" class="d-inline mx-2">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Rejeter</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-adm-layout>
