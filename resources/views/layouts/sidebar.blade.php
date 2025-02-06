<div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <img src="assets/images/logo.svg" alt="" srcset="">
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">

                        <li class="sidebar-item active ">
                            <a href="index.html" class='sidebar-link'>
                                <i data-feather="home" width="20"></i> 
                                <span>Tableau de bord</span>
                            </a>
                        </li>
                        @can('creer demande','voir demandes personnelles')
                            
                        @endcan
                        <li class=" sidebar-title">Espace Personnel</li>

                        <li class="sidebar-item  ">
                            <a href="#" class='sidebar-link'>
                                <i data-feather="triangle" width="20"></i> 
                                <span>Mes demandes</span>
                            </a>
                        </li>

                        
                        <li class="sidebar-item  ">
                            <a href="#" class='sidebar-link'>
                                <i data-feather="briefcase" width="20"></i> 
                                <span>Mes brouillons</span>
                            </a>
                        </li>  

                        @endcan
                        @if (auth()->user()->hasRole('directeur','grh','chef de service'))
                                      
            
                        <li class="sidebar-title">Administration</li>

                        <li class="sidebar-item">
                            <a href="#" class='sidebar-link'>
                                <i data-feather="file-text" width="20"></i> 
                                <span>Demandes</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="#" class='sidebar-link'>
                                <i data-feather="file-text" width="20"></i> 
                                <span>Employes</span>
                            </a>
                        </li>

                        @endif

                        @if (auth()->user()->hasRole('grh'))
                            
                        

                        <li class="sidebar-item  ">
                            <a href="form-layout.html" class='sidebar-link'>
                                <i data-feather="layout" width="20"></i> 
                                <span>Services</span>
                            </a>
                    
                        </li>

                        <li class="sidebar-item  ">
                            <a href="form-editor.html" class='sidebar-link'>
                                <i data-feather="layers" width="20"></i> 
                                <span>Fonctions</span>
                            </a>
                        </li>

                        @endif

                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>