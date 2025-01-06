
<div class="sidebar" data-background-color="dark">
        <div class="sidebar-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
            <a href="/" class="logo">
              <img src="{{asset('assets/img/logo.jpg')}}" style="width: 50px; height: auto; border-radius: 50%; object-fit: cover"  alt="Logo" />
                
            
              <!----J'ai enleve le logo de ici  Je vais chercher un logo en attendant-->
              <p>
        <span style="color: white; font-weight: bold; font-size: 20px;  font-family: Arial;">
          <span style="color: blue;">G</span>EST<span style="color: blue;">D</span>ECHET
    </p>
    
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
          <div class="sidebar-content">
            <ul class="nav nav-secondary">
              <li class="nav-item active">
                <a
                  data-bs-toggle="collapse"
                  href="#dashboard"
                  class="collapsed"
                  aria-expanded="false"
                >
                  <i class="fas fa-home"></i>
                 
                  <p>Dashboard</p>
                  <span class="caret"></span>
                  <a href="/accueil">
                </a>
                <div class="collapse" id="dashboard">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="/accueil">
                        <span class="sub-item">Accueil</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                
              </li>
              <!--li class="nav-item">
                <a data-bs-toggle="collapse" href="#base">
                  <i class="fas fa-users"></i>
                  <p>Utilisateurs</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="base">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="/resident">
                      <i class="fas fa-home"></i>
                        <span class="sub-item">Residents</span>
                      </a>
                    </li>
                    <li>
                      <a href="/autorite">
                        <i class="fas fa-building"></i>
                        <span class="sub-item">Mairie</span>
                      </a>
                    </li>
                    <li>
                      <a href="/entreprise">
                        <i class="fas fa-industry"></i>
                        <span class="sub-item">Entreprises</span>
                      </a>
                    </li>
                   
                  </ul>
                </div>
              </li-->
               {{-- Si l'utilisateur est un résident --}}
                @if(Auth::guard('resident')->check())
                    <li class="nav-item">
                        <a href="/signalement">
                            <i class="fas fa-trash-alt"></i>
                            <p>Mes Signalements</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/signalements/create">
                            <i class="fas fa-exclamation-circle"></i>
                            <p>Faire signalements</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/services">
                            <i class="fas fa-recycle"></i>
                            <p>Services de recyclage</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/resident/profile">
                            <i class="fas fa-user"></i>
                            <p>Profil</p>
                        </a>
                    </li>
                {{-- Si l'utilisateur est une mairie --}}
                @elseif(Auth::guard('mairie')->check())
                    <li class="nav-item">
                        <a href="/mairie/signalements">
                            <i class="fas fa-trash-alt"></i>
                            <p>Gestion Signalements</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/taches">
                            <i class="fas fa-tasks"></i>
                            <p>Gestion Taches</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/equipes">
                            <i class="fas fa-truck-loading"></i>
                            <p>Gestion Equipes</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/mairie/profile">
                            <i class="fas fa-user"></i>
                            <p>Profil </p>
                        </a>
                    </li>
                {{-- Si l'utilisateur est une entreprise --}}
                @elseif(Auth::guard('entreprise')->check())
                    <li class="nav-item">
                        <a href="/services">
                            <i class="fas fa-recycle"></i>
                            <p>Services de recyclage</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/service/create">
                            <i class="fas fa-plus-circle"></i>
                            <p>Proposer un Service</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/entreprise/profile">
                            <i class="fas fa-user"></i>
                            <p>Profil</p>
                        </a>
                    </li>
                {{-- Si l'utilisateur est un admin --}}
                @elseif(Auth::guard('admin')->check())
                    <li class="nav-item">
                        <a href="/comptes">
                            <i class="fas fa-users"></i>
                            <p>Comptes</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/signalement">
                            <i class="fas fa-trash-alt"></i>
                            <p>Mes Signalements</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/signalements/create">
                            <i class="fas fa-exclamation-circle"></i>
                            <p>Faire signalements</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/mairie/signalements">
                            <i class="fas fa-trash-alt"></i>
                            <p>Gestion Signalements</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/taches">
                            <i class="fas fa-tasks"></i>
                            <p>Gestion Taches</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/equipes">
                            <i class="fas fa-truck-loading"></i>
                            <p>Gestion Equipes</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/services">
                            <i class="fas fa-recycle"></i>
                            <p>Services de recyclage</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/service/create">
                            <i class="fas fa-plus-circle"></i>
                            <p>Proposer un Service</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/profile">
                            <i class="fas fa-user"></i>
                            <p>Profil</p>
                        </a>
                    </li>
                @endif
            </ul>
          </div>
        </div>
      </div>
      