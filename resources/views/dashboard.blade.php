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
                            <div class="count-number text-primary">{{ $mesdemandes->count() }}</div>
                            <p class="text-muted mb-3">Demandes totales</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span
                                        class="badge  me-1 text-warning text-xl fw-bold">{{ $mesdemandesencours->count() }}
                                        <i data-feather="clock" class="card-icon text-warning"></i></span>
                                    <span
                                        class="badge  me-1 text-success text-xl fw-bold">{{ $mesdemandesvalidees->count() }}
                                        <i data-feather="check-circle" class="card-icon text-success"></i></span>
                                    <span class="badge text-danger text-xl fw-bold">{{ $mesdemandesrejetees->count() }}
                                        <i data-feather="x" class="card-icon text-danger"></i></span>
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
                                    <div class="count-number text-info">{{ $soldeConges }}</div>
                                    <p class="text-muted small">Jours </p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card bg-white ">
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
                            <div class="count-number text-warning">{{ $mesdemandesencours->count() }}</div>
                            <p class="text-muted mb-3">En attente de validation</p>
                            <ul class="list-group list-group-flush">
                                @foreach ($mesdemandesencours->latest()->take(3)->get() as $demande)
                                    <li class="list-group-item px-0">{{ $demande->type_de_demande }} -
                                        {{ \Carbon\Carbon::parse($demande->date_de_debut)->format('d/m/Y') }} au
                                        {{ \Carbon\Carbon::parse($demande->date_de_fin)->format('d/m/Y') }}</li>
                                @endforeach
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
                                {{ $mesdemandesvalidees->count() + $mesdemandesrejetees->count() }}</div>
                            <p class="text-muted mb-3">Demandes approuvées ou rejetées</p>
                            <div class="d-flex justify-content-between mb-2">
                                <div>Approuvées :</div>
                                <div class="fw-bold">{{ $mesdemandesvalidees->count() }}</div>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <div>Rejetées :</div>
                                <div class="fw-bold">{{ $mesdemandesrejetees->count() }}</div>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item px-0">Dernier congé approuvé
                                    :{{ $mesdemandesvalidees->latest()->first()->date_de_demande }} au
                                    {{ $mesdemandesvalidees->latest()->first()->date_de_demande }}
                                </li>
                                </li>
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
                            <div class="count-number text-secondary">{{ $mesdemandesbrouillons->count() }}</div>
                            <p class="text-muted mb-3">Demandes non soumises</p>
                            <ul class="list-group list-group-flush">
                                @foreach ($mesdemandesbrouillons->latest()->take(3)->get() as $demande)
                                    <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                                        {{ $demande->type_de_demande }}
                                        <a href="{{ route('demandes.edit_brouillon', $demande) }}"
                                            class="btn btn-sm btn-outline-secondary">Éditer</a>
                                    </li>
                                @endforeach
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
                            <div class="count-number text-primary">{{ $touteslesdemandes->count() }}</div>
                            <p class="text-muted mb-3">Demandes totales</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="badge me-1 text-warning text-xl fw-bold">{{ $enCours->count() }}
                                        <i data-feather="clock" class="card-icon text-warning"></i></span>
                                    <span class="badge me-1 text-success text-xl fw-bold">{{ $validees->count() }}
                                        <i data-feather="check-circle" class="card-icon text-success"></i></span>
                                    <span class="badge text-danger text-xl fw-bold">{{ $rejetees->count() }}
                                        <i data-feather="x" class="card-icon text-danger"></i></span>
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
                            <div class="count-number text-info">{{ $mesdemandes->count() }}</div>
                            <p class="text-muted mb-3">Mes demandes personnelles</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span
                                        class="badge me-1 text-warning text-xl fw-bold">{{ $mesdemandesencours->count() }}
                                        <i data-feather="clock" class="card-icon text-warning"></i></span>
                                    <span
                                        class="badge me-1 text-success text-xl fw-bold">{{ $mesdemandesvalidees->count() }}
                                        <i data-feather="check-circle" class="card-icon text-success"></i></span>
                                    <span
                                        class="badge text-danger text-xl fw-bold">{{ $mesdemandesrejetees->count() }}
                                        <i data-feather="x" class="card-icon text-danger"></i></span>
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
                            <div class="count-number text-secondary">{{ $mesdemandesbrouillons->count() }}</div>
                            <p class="text-muted mb-3">Demandes non soumises</p>
                            <ul class="list-group list-group-flush">
                                @foreach ($mesdemandesbrouillons->latest()->take(3)->get() as $demande)
                                    <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                                        {{ $demande->type_de_demande }}
                                        <a href="{{ route('demandes.edit_brouillon', $demande) }}"
                                            class="btn btn-sm btn-outline-secondary">Éditer</a>
                                    </li>
                                @endforeach
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
                                <div class="count-number text-warning">{{ $enCours->count() }}</div>
                                <p class="text-muted mb-3">En attente de validation</p>
                                <ul class="list-group list-group-flush">
                                    @foreach ($enCours->latest()->take(3)->get() as $demande)
                                        <li class="list-group-item px-0">{{ $demande->type_de_demande }} -
                                            {{ \Carbon\Carbon::parse($demande->date_de_debut)->format('d/m/Y') }} au
                                            {{ \Carbon\Carbon::parse($demande->date_de_fin)->format('d/m/Y') }}</li>
                                    @endforeach
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
                                <div class="count-number text-success">{{ $validees->count() }}</div>
                                <p class="text-muted mb-3">Demandes validées</p>
                                <ul class="list-group list-group-flush">
                                    @foreach ($validees->latest()->take(2)->get() as $demande)
                                        <li
                                            class="list-group-item px-0 d-flex justify-content-between align-items-center">
                                            {{ $demande->type_de_demande }} - {{ $demande->employe->nom }}
                                            {{ $demande->employe->prenom }}
                                        </li>
                                    @endforeach
                                </ul>
                                <ul class="list-group list-group-flush bg-transparent">
                                    <li class="list-group-item bg-transparent text-light border-dark">Dernière demande
                                        :
                                        {{ $validees->latest()->first()->type_de_demande }} -
                                        {{ $validees->latest()->first()->employe->nom }}
                                        {{ $validees->latest()->first()->employe->prenom }}</li>
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
                                <div class="count-number text-danger">{{ $rejetees->count() }}</div>
                                <p class="text-muted mb-3">Demandes non approuvées</p>
                                <ul class="list-group list-group-flush">
                                    @foreach ($rejetees->latest()->take(3)->get() as $demande)
                                        <li
                                            class="list-group-item px-0 d-flex justify-content-between align-items-center">
                                            {{ $demande->type_de_demande }} - {{ $demande->employe->nom }}
                                            {{ $demande->employe->prenom }}
                                        </li>
                                    @endforeach
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
                                <div class="count-number text-info">{{ $totalUtilisateurs }}</div>
                                <p class="text-muted mb-3">Employés actifs</p>
                                <ul class="list-group list-group-flush bg-transparent">
                                    <li class="list-group-item bg-transparent text-light border-dark">Jean Dupont -
                                        Développeur</li>
                                    <li class="list-group-item bg-transparent text-light border-dark">Marie Curie - RH
                                    </li>
                                    <li class="list-group-item bg-transparent text-light border-dark">Paul Durand -
                                        Chef de
                                        projet</li>
                                </ul>
                                {{-- <ul class="list-group list-group-flush">
                                    @foreach ($derniersUtilisateurs as $user)
                                        <li
                                            class="list-group-item px-0 d-flex justify-content-between align-items-center">
                                            {{ $user->nom }} {{ $user->prenom }} -
                                            {{ $user->fonction }}
                                        </li>
                                    @endforeach
                                </ul> --}}
                                <div class="text-end mt-3">
                                    <a href="#" class="btn btn-sm btn-outline-info btn-action">Gérer</a>
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
                                <div class="count-number text-warning">{{ $totalServices }}</div>
                                <p class="text-muted mb-3">Services disponibles</p>
                                <ul class="list-group list-group-flush bg-transparent">
                                    <li class="list-group-item bg-transparent text-light border-dark">Développement
                                    </li>
                                    <li class="list-group-item bg-transparent text-light border-dark">Ressources
                                        Humaines
                                    </li>
                                    <li class="list-group-item bg-transparent text-light border-dark">Marketing</li>
                                </ul>
                                <div class="text-end mt-3">
                                    <a href="#" class="btn btn-sm btn-outline-warning btn-action">Gérer</a>
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
                                <div class="count-number text-success">{{ $totalFonctions }}</div>
                                <p class="text-muted mb-3">Fonctions disponibles</p>
                                <ul class="list-group list-group-flush bg-transparent">
                                    <li class="list-group-item bg-transparent text-light border-dark">Développeur</li>
                                    <li class="list-group-item bg-transparent text-light border-dark">Chef de projet
                                    </li>
                                    <li class="list-group-item bg-transparent text-light border-dark">Responsable RH
                                    </li>
                                </ul>
                                <div class="text-end mt-3">
                                    <a href="#" class="btn btn-sm btn-outline-success btn-action">Gérer</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @endif
</x-adm-layout>
