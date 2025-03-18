<div id="sidebar" class='active'>
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <img src="{{ asset('assets/images/logo.jpg') }}" alt="Logo E-Sica" style="height: auto; width: 80%;" />
        </div>
        <div class="sidebar-menu">
            <ul class="menu">

                <li class="sidebar-item @if (request()->is('dashboard*')) active @endif">
                    <a href="/dashboard" class='sidebar-link'>
                        <i data-feather="home" width="20"></i>
                        <span>Tableau de bord</span>
                    </a>
                </li>

                <li class=" sidebar-title">Espace Personnel</li>

                <li class="sidebar-item @if (request()->is('mesdemandes*')) active @endif">
                    <a href="{{ route('mesdemandes.index') }}" class='sidebar-link'>
                        <i data-feather="file-text" width="20"></i>
                        <span>Mes demandes</span>
                    </a>
                </li>


                <li class="sidebar-item @if (request()->is('brouillons*')) active @endif">
                    <a href="{{ route('demandes.brouillons') }}" class='sidebar-link'>
                        <i data-feather="briefcase" width="20"></i>
                        <span>Mes brouillons</span>
                    </a>
                </li>

                @if (auth()->user()->hasRole(['directeur', 'grh', 'chef de service']))

                    <li class="sidebar-title">Administration</li>

                    <li class="sidebar-item @if (request()->is('demandes*')) active @endif">
                        <a href="{{ route('demandes.index') }}" class='sidebar-link'>
                            <i data-feather="file-text" width="20"></i>
                            <span>Traiter les demandes</span>
                        </a>
                    </li>

                    <li class="sidebar-item @if (request()->is('employes*')) active @endif">
                        <a href="{{ route('employes.index') }}" class='sidebar-link'>
                            <i data-feather="users" width="20"></i>
                            <span>Employes</span>
                        </a>
                    </li>



                    @if (auth()->user()->hasRole(['directeur', 'grh']))
                        <li class="sidebar-item  @if (request()->is('services*')) active @endif">
                            <a href="{{ route('services.index') }}" class='sidebar-link'>
                                <i data-feather="layers" width="20"></i>
                                <span>Services</span>
                            </a>

                        </li>

                        <li class="sidebar-item  @if (request()->is('fonctions*')) active @endif">
                            <a href="{{ route('fonctions.index') }}" class='sidebar-link'>
                                <i data-feather="briefcase" width="20"></i>
                                <span>Fonctions</span>
                            </a>
                        </li>
                    @endif

                @endif

            </ul>

        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
