<x-adm-layout>
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                @php
                    $user = Auth::user();
                @endphp


                    @if($user->type == 'chef de service')
                        <div class="col-12 col-md-6 order-md-1 order-first">
                            <h3>Demandes</h3>
                            <p class="text-subtitle text-muted">Traitez les demandes de vos collaborateurs</p>
                        </div>
                    @else
                        <div class="col-12 col-md-6 order-md-1 order-first">
                            <h3>Demandes</h3>
                            <p class="text-subtitle text-muted">Traitez toutes les demandes de votre organisation</p>
                        </div>
                    @endif
            </div>
        </div>
            @if ($user->type == 'directeur' || $user->type == 'grh')
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
                                    @foreach ($demandes as $demande)
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
                                            <td class="d-md-flex justify-content-lg-between ">
                                                <a href="{{route('demandes.show',$demande->id)}}" class="btn btn-warning">Details</a>
                                                @if ($demande->status === 'encours' && $user->can('process', $demande))
                                                    <form action="{{ route('demandes.approve', $demande) }}" method="post" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success">Approuver</button>
                                                    </form>
                                                    <form action="{{ route('demandes.reject', $demande) }}" method="post" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">Rejeter</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            @endif

            @if ($user->type == 'chef de service')
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
                                    @foreach ($demandesService as $demande)
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
                                            <td class="d-md-flex justify-content-lg-between ">
                                                <a href="{{route('demandes.show',$demande->id)}}" class="btn btn-warning">Details</a>
                                                @if ($demande->status === 'encours' && $user->can('process', $demande))
                                                    <form action="{{ route('demandes.approve', $demande) }}" method="post" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success">Approuver</button>
                                                    </form>
                                                    <form action="{{ route('demandes.reject', $demande) }}" method="post" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">Rejeter</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            @endif
    </div>
</x-adm-layout>
