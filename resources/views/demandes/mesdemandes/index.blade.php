<x-adm-layout>
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-first">
                    <h3>Mes demandes</h3>
                    <p class="text-subtitle text-muted">Consultez et gérez vos demandes</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-last d-flex justify-content-end">
                    <a href="{{ route('mesdemandes.create') }}">
                        <div class="btn btn-success"><i data-feather="plus-circle"></i> Créer une nouvelle demande</div>
                    </a>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Demandeur</th>
                                <th>Type de demande</th>
                                <th>Motif</th>
                                <th>Date de demande</th>
                                <th>Période</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mesdemandes as $demande)
                                <tr>
                                    <td>{{ $demande->employe->nom ?? 'Non défini' }} {{ $demande->employe->prenom ?? 'Non défini' }}</td>
                                    <td>
                                        <span class="badge bg-primary">{{ ucfirst($demande->type_de_demande) }}</span>
                                    </td>
                                    <td>{{ Str::limit($demande->motif, 50) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($demande->date_de_demande)->format('d/m/Y') }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($demande->date_de_debut)->format('d/m/Y') }} -
                                        {{ \Carbon\Carbon::parse($demande->date_de_fin)->format('d/m/Y') }}
                                    </td>
                                    <td>
                                        @if ($demande->status === 'accorde')
                                            <span class="badge bg-success">Accordée</span>
                                        @elseif ($demande->status === 'rejete')
                                            <span class="badge bg-danger">Rejetée</span>
                                        @else
                                            <span class="badge bg-secondary">En cours</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('mesdemandes.show', $demande->id) }}" class="btn btn-warning">Détails</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</x-adm-layout>
