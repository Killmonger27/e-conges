<x-adm-layout>
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-first">
                    <h3>Mes demandes au brouillon</h3>
                    <p class="text-subtitle text-muted">Consultez et gérez vos demandes au brouillon.</p>
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
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brouillons as $demande)
                                <tr>
                                    <td>{{ $demande->employe->nom?? 'Non défini' }} {{ $demande->employe->prenom?? 'Non défini' }}</td>
                                    <td>
                                        <span class="badge bg-primary">{{ ucfirst($demande->type_de_demande) }}</span>
                                    </td>
                                    <td>{{ Str::limit($demande->motif, 50) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($demande->created_at)->format('d/m/Y') }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($demande->date_de_debut)->format('d/m/Y') }} -
                                        {{ \Carbon\Carbon::parse($demande->date_de_fin)->format('d/m/Y') }}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('demandes.show_brouillon', $demande) }}" class="btn btn-warning">Details</a>
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
