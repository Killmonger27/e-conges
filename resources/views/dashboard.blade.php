<x-adm-layout>
    @php
        $user = Auth::user();
    @endphp

    @if ($user->hasRole('employe'))
        <div class="main-content container-fluid dashboard-container">

            <!-- Section Vue d'ensemble -->
            <div class="row mb-2">
                <div class="col-12">
                    <h3>Vue d'ensemble</h3>
                </div>
            </div>
            <div class="row row-equal mb-4">
                <div class="col-md-4">
                    <div class="card bg-white">
                        <div class="card-body">
                            <h5>
                                <i data-feather="file-text" class="card-icon text-primary"></i>
                                Toutes mes demandes
                            </h5>
                            <div class="count-number text-primary">{{ $mesdemandes->count() ?? 0 }}</div>
                            <p class="text-muted mb-3">Demandes totales</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="badge me-1 text-warning text-xl fw-bold">
                                        {{ $mesdemandesencours->count() ?? 0 }}
                                        <i data-feather="clock" class="card-icon text-warning"></i>
                                    </span>
                                    <span class="badge me-1 text-success text-xl fw-bold">
                                        {{ $mesdemandesvalidees->count() ?? 0 }}
                                        <i data-feather="check-circle" class="card-icon text-success"></i>
                                    </span>
                                    <span class="badge text-danger text-xl fw-bold">
                                        {{ $mesdemandesrejetees->count() ?? 0 }}
                                        <i data-feather="x" class="card-icon text-danger"></i>
                                    </span>
                                </div>
                                <a href="{{ route('mesdemandes.index') }}"
                                    class="btn btn-sm btn-outline-primary btn-action">Voir tout</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card bg-white">
                        <div class="card-body">
                            <h5>
                                <i data-feather="calendar" class="card-icon text-info"></i>
                                Solde de congés
                            </h5>
                            <div class="row text-center mb-3">
                                <div class="col-4">
                                    <div class="count-number text-info">{{ $soldeConges ?? 0 }}</div>
                                    <p class="text-muted small">Jours</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card bg-white">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5>
                                    <i data-feather="plus-circle" class="card-icon text-primary"></i>
                                    Nouvelle demande
                                </h5>
                                <p class="text-muted mb-4">Créer une nouvelle demande de congés ou d'absence</p>
                            </div>
                            <div>
                                <button onclick="window.location.href='{{ route('mesdemandes.create') }}'"
                                    class="btn btn-primary w-75">Créer une demande</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section Demandes par statut -->
            <div class="row mb-2">
                <div class="col-12">
                    <h3>Demandes par statut</h3>
                </div>
            </div>
            <div class="row row-equal mb-4">
                <div class="col-md-4">
                    <div class="card bg-white">
                        <div class="card-body">
                            <h5>
                                <i data-feather="clock" class="card-icon text-warning"></i>
                                Mes demandes en cours
                            </h5>
                            <div class="count-number text-warning">{{ $mesdemandesencours->count() ?? 0 }}</div>
                            <p class="text-muted mb-3">En attente de validation</p>
                            <ul class="list-group list-group-flush">
                                @if ($mesdemandesencours->count() > 0)
                                    @foreach ($mesdemandesencours->latest()->take(3)->get() as $demande)
                                        <li class="list-group-item px-0">
                                            {{ $demande->type_de_demande ?? 'Type de demande non spécifié' }} -
                                            @if ($demande->date_de_debut)
                                                {{ \Carbon\Carbon::parse($demande->date_de_debut)->format('d/m/Y') }}
                                            @else
                                                Date de début non spécifiée
                                            @endif
                                            au
                                            @if ($demande->date_de_fin)
                                                {{ \Carbon\Carbon::parse($demande->date_de_fin)->format('d/m/Y') }}
                                            @else
                                                Date de fin non spécifiée
                                            @endif
                                        </li>
                                    @endforeach
                                @else
                                    <li class="list-group-item px-0">Aucune demande en cours.</li>
                                @endif
                            </ul>
                            <div class="text-end mt-3">
                                <a href="{{ route('mesdemandes.index') }}"
                                    class="btn btn-sm btn-outline-warning btn-action">Gérer</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card bg-white">
                        <div class="card-body">
                            <h5>
                                <i data-feather="check-circle" class="card-icon text-success"></i>
                                Mes demandes traitées
                            </h5>
                            <div class="count-number text-success">
                                {{ ($mesdemandesvalidees->count() ?? 0) + ($mesdemandesrejetees->count() ?? 0) }}
                            </div>
                            <p class="text-muted mb-3">Demandes approuvées ou rejetées</p>
                            <div class="d-flex justify-content-between mb-2">
                                <div>Approuvées :</div>
                                <div class="fw-bold">{{ $mesdemandesvalidees->count() ?? 0 }}</div>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <div>Rejetées :</div>
                                <div class="fw-bold">{{ $mesdemandesrejetees->count() ?? 0 }}</div>
                            </div>
                            <ul class="list-group list-group-flush">
                                @if ($mesdemandesvalidees->count() > 0)
                                    <li class="list-group-item px-0">
                                        Dernier congé approuvé :
                                        @if ($mesdemandesvalidees->latest()->first()->date_de_demande)
                                            {{ \Carbon\Carbon::parse($mesdemandesvalidees->latest()->first()->date_de_demande)->format('d/m/Y') }}
                                        @else
                                            Date non spécifiée
                                        @endif
                                    </li>
                                @else
                                    <li class="list-group-item px-0">Aucune demande validée.</li>
                                @endif
                            </ul>
                            <div class="text-end mt-3">
                                <a href="{{ route('mesdemandes.index') }}"
                                    class="btn btn-sm btn-outline-success btn-action">Consulter</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card bg-white">
                        <div class="card-body">
                            <h5>
                                <i data-feather="file-text" class="card-icon text-secondary"></i>
                                Mes demandes au brouillon
                            </h5>
                            <div class="count-number text-secondary">{{ $mesdemandesbrouillons->count() ?? 0 }}</div>
                            <p class="text-muted mb-3">Demandes non soumises</p>
                            <ul class="list-group list-group-flush">
                                @if ($mesdemandesbrouillons->count() > 0)
                                    @foreach ($mesdemandesbrouillons->latest()->take(3)->get() as $demande)
                                        <li
                                            class="list-group-item px-0 d-flex justify-content-between align-items-center">
                                            {{ $demande->type_de_demande ?? 'Type de demande non spécifié' }}
                                            <a href="{{ route('demandes.edit_brouillon', $demande) }}"
                                                class="btn btn-sm btn-outline-secondary">Éditer</a>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="list-group-item px-0">Aucun brouillon disponible.</li>
                                @endif
                            </ul>
                            <div class="text-end mt-3">
                                <a href="{{ route('demandes.brouillons') }}"
                                    class="btn btn-sm btn-outline-secondary btn-action">Voir tout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($user->hasRole('chef de service'))
        <div class="main-content container-fluid dashboard-container">

            <!-- Section Vue d'ensemble -->
            <div class="row mb-2">
                <div class="col-12">
                    <h3>Vue d'ensemble</h3>
                </div>
            </div>
            <div class="row row-equal mb-4">
                <div class="col-md-4">
                    <div class="card bg-white">
                        <div class="card-body">
                            <h5>
                                <i data-feather="file-text" class="card-icon text-primary"></i>
                                Toutes les demandes
                            </h5>
                            <div class="count-number text-primary">{{ $mesdemandes->count() ?? 0 }}</div>
                            <p class="text-muted mb-3">Demandes totales</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="badge me-1 text-warning text-xl fw-bold">
                                        {{ $mesdemandesencours->count() ?? 0 }}
                                        <i data-feather="clock" class="card-icon text-warning"></i>
                                    </span>
                                    <span class="badge me-1 text-success text-xl fw-bold">
                                        {{ $mesdemandesvalidees->count() ?? 0 }}
                                        <i data-feather="check-circle" class="card-icon text-success"></i>
                                    </span>
                                    <span class="badge text-danger text-xl fw-bold">
                                        {{ $mesdemandesrejetees->count() ?? 0 }}
                                        <i data-feather="x" class="card-icon text-danger"></i>
                                    </span>
                                </div>
                                <a href="{{ route('mesdemandes.index') }}"
                                    class="btn btn-sm btn-outline-primary btn-action">Voir tout</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card bg-white">
                        <div class="card-body">
                            <h5>
                                <i data-feather="calendar" class="card-icon text-info"></i>
                                Solde de congés
                            </h5>
                            <div class="row text-center mb-3">
                                <div class="col-4">
                                    <div class="count-number text-info">{{ $soldeConges ?? 0 }}</div>
                                    <p class="text-muted small">Jours</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card bg-white">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5>
                                    <i data-feather="plus-circle" class="card-icon text-primary"></i>
                                    Nouvelle demande
                                </h5>
                                <p class="text-muted mb-4">Créer une nouvelle demande de congés ou d'absence</p>
                            </div>
                            <div>
                                <button onclick="window.location.href='{{ route('mesdemandes.create') }}'"
                                    class="btn btn-primary w-75">Créer une demande</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section Vue du service -->
            <div class="row mb-2">
                <div class="col-12">
                    <h3>Vue du service</h3>
                </div>
            </div>
            <div class="row row-equal mb-4">
                <div class="col-md-4">
                    <div class="card bg-white">
                        <div class="card-body">
                            <h5>
                                <i data-feather="file-text" class="card-icon text-primary"></i>
                                Toutes les demandes du service
                            </h5>
                            <div class="count-number text-primary">{{ $demandesService->count() ?? 0 }}</div>
                            <p class="text-muted mb-3">Demandes totales</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="badge me-1 text-warning text-xl fw-bold">
                                        {{ $demandesService->where('status', 'encours')->count() ?? 0 }}
                                        <i data-feather="clock" class="card-icon text-warning"></i>
                                    </span>
                                    <span class="badge me-1 text-success text-xl fw-bold">
                                        {{ $demandesServiceAccorde->count() ?? 0 }}
                                        <i data-feather="check-circle" class="card-icon text-success"></i>
                                    </span>
                                    <span class="badge text-danger text-xl fw-bold">
                                        {{ $demandesServiceRejete->count() ?? 0 }}
                                        <i data-feather="x" class="card-icon text-danger"></i>
                                    </span>
                                </div>
                                <a href="{{ route('demandes.index') }}"
                                    class="btn btn-sm btn-outline-primary btn-action">Voir tout</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card bg-white">
                        <div class="card-body">
                            <h5>
                                <i data-feather="check-circle" class="card-icon text-success"></i>
                                Demandes du service traitées
                            </h5>
                            <div class="count-number text-success">
                                {{ ($demandesServiceAccorde->count() ?? 0) + ($demandesServiceRejete->count() ?? 0) }}
                            </div>
                            <p class="text-muted mb-3">Demandes approuvées ou rejetées</p>
                            <div class="d-flex justify-content-between mb-2">
                                <div>Approuvées :</div>
                                <div class="fw-bold">{{ $demandesServiceAccorde->count() ?? 0 }}</div>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <div>Rejetées :</div>
                                <div class="fw-bold">{{ $demandesServiceRejete->count() ?? 0 }}</div>
                            </div>
                            <div class="text-end mt-3">
                                <a href="{{ route('demandes.index') }}"
                                    class="btn btn-sm btn-outline-success btn-action">Consulter</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card bg-dark-gradient hover-scale">
                        <div class="card-body">
                            <h5 class="text-light">
                                <i data-feather="users" class="card-icon text-info"></i>
                                Liste des employés
                            </h5>
                            <div class="count-number text-info">{{ $totalEmployes ?? 0 }}</div>
                            <p class="text-muted mb-3">Employés actifs</p>
                            <ul class="list-group list-group-flush">
                                @if ($derniersEmployes->count() > 0)
                                    @foreach ($derniersEmployes as $user)
                                        <li
                                            class="list-group-item px-0 d-flex justify-content-between align-items-center">
                                            {{ $user->nom }} {{ $user->prenom }} -
                                            @if ($user->fonction && $user->fonction->intitule)
                                                {{ $user->fonction->intitule }}
                                            @else
                                                Intitulé non disponible
                                            @endif
                                        </li>
                                    @endforeach
                                @else
                                    <li class="list-group-item px-0">Aucun employé trouvé.</li>
                                @endif
                            </ul>
                            <div class="text-end mt-3">
                                <a href="{{ route('employes.index') }}"
                                    class="btn btn-sm btn-outline-info btn-action">Gérer</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($user->hasRole('grh'))
        <div class="main-content container-fluid dashboard-container">

            <!-- Section Vue d'ensemble -->
            <div class="row mb-4">
                <div class="col-12">
                    <h3 class="text-light mb-3">Vue d'ensemble</h3>
                </div>
                <!-- Carte : Toutes les demandes -->
                <div class="col-md-4">
                    <div class="card bg-dark-gradient hover-scale">
                        <div class="card-body">
                            <h5 class="text-light">
                                <i data-feather="file-text" class="card-icon text-primary"></i>
                                Toutes les demandes
                            </h5>
                            <div class="count-number text-primary">{{ $touteslesdemandes->count() ?? 0 }}</div>
                            <p class="text-muted mb-3">Demandes totales</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="badge me-1 text-warning text-xl fw-bold">{{ $enCours->count() ?? 0 }}
                                        <i data-feather="clock" class="card-icon text-warning"></i>
                                    </span>
                                    <span
                                        class="badge me-1 text-success text-xl fw-bold">{{ $validees->count() ?? 0 }}
                                        <i data-feather="check-circle" class="card-icon text-success"></i>
                                    </span>
                                    <span class="badge text-danger text-xl fw-bold">{{ $rejetees->count() ?? 0 }}
                                        <i data-feather="x" class="card-icon text-danger"></i>
                                    </span>
                                </div>
                                <a href="{{ route('demandes.index') }}"
                                    class="btn btn-sm btn-outline-primary btn-action">Voir tout</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Carte : Mes demandes -->
                <div class="col-md-4">
                    <div class="card bg-dark-gradient hover-scale">
                        <div class="card-body">
                            <h5 class="text-light">
                                <i data-feather="file-text" class="card-icon text-info"></i>
                                Mes demandes
                            </h5>
                            <div class="count-number text-info">{{ $mesdemandes->count() ?? 0 }}</div>
                            <p class="text-muted mb-3">Mes demandes personnelles</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span
                                        class="badge me-1 text-warning text-xl fw-bold">{{ $mesdemandesencours->count() ?? 0 }}
                                        <i data-feather="clock" class="card-icon text-warning"></i>
                                    </span>
                                    <span
                                        class="badge me-1 text-success text-xl fw-bold">{{ $mesdemandesvalidees->count() ?? 0 }}
                                        <i data-feather="check-circle" class="card-icon text-success"></i>
                                    </span>
                                    <span
                                        class="badge text-danger text-xl fw-bold">{{ $mesdemandesrejetees->count() ?? 0 }}
                                        <i data-feather="x" class="card-icon text-danger"></i>
                                    </span>
                                </div>
                                <a href="{{ route('mesdemandes.index') }}"
                                    class="btn btn-sm btn-outline-info btn-action">Voir tout</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Carte : Mes brouillons -->
                <div class="col-md-4">
                    <div class="card bg-white">
                        <div class="card-body">
                            <h5>
                                <i data-feather="file-text" class="card-icon text-secondary"></i>
                                Mes demandes au brouillon
                            </h5>
                            <div class="count-number text-secondary">{{ $mesdemandesbrouillons->count() ?? 0 }}</div>
                            <p class="text-muted mb-3">Demandes non soumises</p>
                            <ul class="list-group list-group-flush">
                                @if ($mesdemandesbrouillons->count() > 0)
                                    @foreach ($mesdemandesbrouillons->latest()->take(3)->get() as $demande)
                                        <li
                                            class="list-group-item px-0 d-flex justify-content-between align-items-center">
                                            {{ $demande->type_de_demande ?? 'Type de demande non spécifié' }}
                                            <a href="{{ route('demandes.edit_brouillon', $demande) }}"
                                                class="btn btn-sm btn-outline-secondary">Éditer</a>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="list-group-item px-0">Aucun brouillon disponible.</li>
                                @endif
                            </ul>
                            <div class="text-end mt-3">
                                <a href="{{ route('demandes.brouillons') }}"
                                    class="btn btn-sm btn-outline-secondary btn-action">Voir tout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section Demandes par statut -->
            <div class="row mb-4">
                <div class="col-12">
                    <h3 class="text-light mb-3">Demandes par statut</h3>
                </div>
                <!-- Carte : Demandes en attente -->
                <div class="row row-equal mb-4">
                    <div class="col-md-4">
                        <div class="card bg-white">
                            <div class="card-body">
                                <h5>
                                    <i data-feather="clock" class="card-icon text-warning"></i>
                                    Demandes en cours
                                </h5>
                                <div class="count-number text-warning">{{ $enCours->count() ?? 0 }}</div>
                                <p class="text-muted mb-3">En attente de validation</p>
                                <ul class="list-group list-group-flush">
                                    @if ($enCours->count() > 0)
                                        @foreach ($enCours->latest()->take(3)->get() as $demande)
                                            <li class="list-group-item px-0">
                                                {{ $demande->type_de_demande ?? 'Type de demande non spécifié' }} -
                                                @if ($demande->date_de_debut)
                                                    {{ \Carbon\Carbon::parse($demande->date_de_debut)->format('d/m/Y') }}
                                                @else
                                                    Date de début non spécifiée
                                                @endif
                                                au
                                                @if ($demande->date_de_fin)
                                                    {{ \Carbon\Carbon::parse($demande->date_de_fin)->format('d/m/Y') }}
                                                @else
                                                    Date de fin non spécifiée
                                                @endif
                                            </li>
                                        @endforeach
                                    @else
                                        <li class="list-group-item px-0">Aucune demande en cours.</li>
                                    @endif
                                </ul>
                                <div class="text-end mt-3">
                                    <a href="{{ route('demandes.index') }}"
                                        class="btn btn-sm btn-outline-warning btn-action">Traiter</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Carte : Demandes approuvées -->
                    <div class="col-md-4">
                        <div class="card bg-dark-gradient hover-scale">
                            <div class="card-body">
                                <h5 class="text-light">
                                    <i data-feather="check-circle" class="card-icon text-success"></i>
                                    Demandes approuvées
                                </h5>
                                <div class="count-number text-success">{{ $validees->count() ?? 0 }}</div>
                                <p class="text-muted mb-3">Demandes validées</p>
                                <ul class="list-group list-group-flush">
                                    @if ($validees->count() > 0)
                                        @foreach ($validees->latest()->take(2)->get() as $demande)
                                            <li
                                                class="list-group-item px-0 d-flex justify-content-between align-items-center">
                                                {{ $demande->type_de_demande ?? 'Type de demande non spécifié' }} -
                                                {{ $demande->employe->nom ?? 'Nom non spécifié' }}
                                                {{ $demande->employe->prenom ?? 'Prénom non spécifié' }}
                                            </li>
                                        @endforeach
                                    @else
                                        <li class="list-group-item px-0">Aucune demande approuvée.</li>
                                    @endif
                                </ul>
                                <ul class="list-group list-group-flush bg-transparent">
                                    <li class="list-group-item bg-transparent text-light border-dark">
                                        Dernière demande :
                                        @if ($validees->count() > 0)
                                            {{ $validees->latest()->first()->type_de_demande ?? 'Type de demande non spécifié' }}
                                            -
                                            {{ $validees->latest()->first()->employe->nom ?? 'Nom non spécifié' }}
                                            {{ $validees->latest()->first()->employe->prenom ?? 'Prénom non spécifié' }}
                                        @else
                                            Aucune demande approuvée.
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Carte : Demandes rejetées -->
                    <div class="col-md-4">
                        <div class="card bg-dark-gradient hover-scale">
                            <div class="card-body">
                                <h5 class="text-light">
                                    <i data-feather="x" class="card-icon text-danger"></i>
                                    Demandes rejetées
                                </h5>
                                <div class="count-number text-danger">{{ $rejetees->count() ?? 0 }}</div>
                                <p class="text-muted mb-3">Demandes non approuvées</p>
                                <ul class="list-group list-group-flush">
                                    @if ($rejetees->count() > 0)
                                        @foreach ($rejetees->latest()->take(3)->get() as $demande)
                                            <li
                                                class="list-group-item px-0 d-flex justify-content-between align-items-center">
                                                {{ $demande->type_de_demande ?? 'Type de demande non spécifié' }} -
                                                {{ $demande->employe->nom ?? 'Nom non spécifié' }}
                                                {{ $demande->employe->prenom ?? 'Prénom non spécifié' }}
                                            </li>
                                        @endforeach
                                    @else
                                        <li class="list-group-item px-0">Aucune demande rejetée.</li>
                                    @endif
                                </ul>
                                <div class="text-end mt-3">
                                    <a href="{{ route('demandes.index') }}"
                                        class="btn btn-sm btn-outline-danger btn-action">Traiter</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section Gestion des employés, services et fonctions -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h3 class="text-light mb-3">Gestion des employés, services et fonctions</h3>
                    </div>
                    <!-- Carte : Liste des employés -->
                    <div class="col-md-4">
                        <div class="card bg-dark-gradient hover-scale">
                            <div class="card-body">
                                <h5 class="text-light">
                                    <i data-feather="users" class="card-icon text-info"></i>
                                    Liste des employés
                                </h5>
                                <div class="count-number text-info">{{ $totalUtilisateurs ?? 0 }}</div>
                                <p class="text-muted mb-3">Employés actifs</p>
                                <ul class="list-group list-group-flush">
                                    @if ($derniersUtilisateurs->count() > 0)
                                        @foreach ($derniersUtilisateurs as $user)
                                            <li
                                                class="list-group-item px-0 d-flex justify-content-between align-items-center">
                                                {{ $user->nom }} {{ $user->prenom }} -
                                                @if ($user->fonction && $user->fonction->intitule)
                                                    {{ $user->fonction->intitule }}
                                                @else
                                                    Intitulé non disponible
                                                @endif
                                            </li>
                                        @endforeach
                                    @else
                                        <li class="list-group-item px-0">Aucun employé trouvé.</li>
                                    @endif
                                </ul>
                                <div class="text-end mt-3">
                                    <a href="{{ route('employes.index') }}"
                                        class="btn btn-sm btn-outline-info btn-action">Gérer</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Carte : Gestion des services -->
                    <div class="col-md-4">
                        <div class="card bg-dark-gradient hover-scale">
                            <div class="card-body">
                                <h5 class="text-light">
                                    <i data-feather="layers" class="card-icon text-warning"></i>
                                    Gestion des services
                                </h5>
                                <div class="count-number text-warning">{{ $totalServices ?? 0 }}</div>
                                <p class="text-muted mb-3">Services disponibles</p>
                                <ul class="list-group list-group-flush bg-transparent">
                                    @if ($derniersServices->count() > 0)
                                        @foreach ($derniersServices as $service)
                                            <li class="list-group-item bg-transparent text-light border-dark">
                                                {{ $service->libelle ?? 'Libellé non spécifié' }}
                                            </li>
                                        @endforeach
                                    @else
                                        <li class="list-group-item bg-transparent text-light border-dark">Aucun service
                                            disponible.</li>
                                    @endif
                                </ul>
                                <div class="text-end mt-3">
                                    <a href="{{ route('services.index') }}"
                                        class="btn btn-sm btn-outline-warning btn-action">Gérer</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Carte : Gestion des fonctions -->
                    <div class="col-md-4">
                        <div class="card bg-dark-gradient hover-scale">
                            <div class="card-body">
                                <h5 class="text-light">
                                    <i data-feather="briefcase" class="card-icon text-success"></i>
                                    Gestion des fonctions
                                </h5>
                                <div class="count-number text-success">{{ $totalFonctions ?? 0 }}</div>
                                <p class="text-muted mb-3">Fonctions disponibles</p>
                                <ul class="list-group list-group-flush bg-transparent">
                                    @if ($dernieresFonctions->count() > 0)
                                        @foreach ($dernieresFonctions as $fonction)
                                            <li class="list-group-item bg-transparent text-light border-dark">
                                                {{ $fonction->intitule ?? 'Intitulé non spécifié' }}
                                            </li>
                                        @endforeach
                                    @else
                                        <li class="list-group-item bg-transparent text-light border-dark">Aucune
                                            fonction disponible.</li>
                                    @endif
                                </ul>
                                <div class="text-end mt-3">
                                    <a href="{{ route('fonctions.index') }}"
                                        class="btn btn-sm btn-outline-success btn-action">Gérer</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</x-adm-layout>
