<x-adm-layout>
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-first">
                    <h3>Liste des employés</h3>
                    <p class="text-subtitle text-muted">Vous pouvez consulter les informations de vos employés.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-last d-flex justify-content-end">
                <a href="{{ route('employes.create') }}" >
                    <div class="btn btn-success"><i data-feather="plus-circle"></i> Ajouter un employe</div>
                </a>
            </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <table class='table table-striped' id="table1">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Email</th>
                                <th>Service</th>
                                <th>Fonction</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employes as $employe)
                                <tr>
                                    <td>{{ $employe->nom }}</td>
                                    <td>{{ $employe->prenom }}</td>
                                    <td>{{ $employe->email }}</td>
                                    <td>
                                        @if ($employe->service)
                                            {{ $employe->service->libelle }}
                                        @else
                                            <span class="badge bg-danger">Non affecté</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($employe->fonction)
                                            {{ $employe->fonction->intitule }}
                                        @else
                                            <span class="badge bg-danger">Non définie</span>
                                        @endif
                                    </td>
                                    <td class="d-md-flex justify-content-lg-between">
                                        <a href="{{ route('employes.show', $employe->id) }}" class="btn btn-info">Voir</a>
                                        <a href="{{ route('employes.edit', $employe->id) }}" class="btn btn-warning">Modifier</a>
                                        <form action="{{ route('employes.destroy', $employe->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes - vous sûr de vouloir supprimer cet employé ?')">Supprimer</button>
                                        </form>
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