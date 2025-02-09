<div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <img src="{{ asset('assets/images/logo.svg') }}" alt="" srcset="">
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

                        <li class="sidebar-item @if (request()->is('mes-demandes*')) active @endif">
                            <a href="#"  class='sidebar-link'>
                                <i data-feather="triangle" width="20"></i> 
                                <span>Mes demandes</span>
                            </a>
                        </li>

                        
                        <li class="sidebar-item @if (request()->is('mes-brouillons*')) active @endif">
                            <a href="#" class='sidebar-link'>
                                <i data-feather="briefcase" width="20"></i> 
                                <span>Mes brouillons</span>
                            </a>
                        </li>  

                        @if (auth()->user()->hasRole(['directeur','grh','chef de service']))
            
                        <li class="sidebar-title">Administration</li>

                        <li class="sidebar-item @if (request()->is('demandes*')) active @endif">
                            <a href="#" class='sidebar-link'>
                                <i data-feather="file-text" width="20"></i> 
                                <span>Demandes</span>
                            </a>
                        </li>

                        <li class="sidebar-item @if (request()->is('employes*')) active @endif">
                            <a href="{{route('employes.index')}}" class='sidebar-link'>
                                <i data-feather="file-text" width="20"></i> 
                                <span>Employes</span>
                            </a>
                        </li>

                        

                        @if (auth()->user()->hasRole(['directeur','grh']))
                            
                        

                        <li class="sidebar-item  @if (request()->is('services*')) active @endif">
                            <a href="{{ route('services.index') }}" class='sidebar-link'>
                                <i data-feather="layout" width="20"></i> 
                                <span>Services</span>
                            </a>
                    
                        </li>

                        <li class="sidebar-item  @if (request()->is('fonctions*')) active @endif">
                            <a href="{{ route('fonctions.index') }}" class='sidebar-link'>
                                <i data-feather="layers" width="20"></i> 
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