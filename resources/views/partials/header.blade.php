<nav
            class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom"
          >
            <div class="container-fluid">
              <nav
                class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex"
              >
                <div class="input-group">
                  <div class="input-group-prepend">
                    <button type="submit" class="btn btn-search pe-1">
                      <i class="fa fa-search search-icon"></i>
                    </button>
                  </div>
                  <input
                    type="text"
                    placeholder="Recharcher ..."
                    class="form-control"
                  />
                </div>
              </nav>

              <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                <li
                  class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none"
                >
                  <a
                    class="nav-link dropdown-toggle"
                    data-bs-toggle="dropdown"
                    href="#"
                    role="button"
                    aria-expanded="false"
                    aria-haspopup="true"
                  >
                    <i class="fa fa-search"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-search animated fadeIn">
                    <form class="navbar-left navbar-form nav-search">
                      <div class="input-group">
                        <input
                          type="text"
                          placeholder="Search ..."
                          class="form-control"
                        />
                      </div>
                    </form>
                  </ul>
                </li>
                <li class="nav-item topbar-icon dropdown hidden-caret">
                  <a
                    class="nav-link dropdown-toggle"
                    href="#"
                    id="messageDropdown"
                    role="button"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                  >
                    <i class="fa fa-envelope"></i>
                  </a>
                  <ul
                    class="dropdown-menu messages-notif-box animated fadeIn"
                    aria-labelledby="messageDropdown"
                  >
                    {{-- <li>
                      <div
                        class="dropdown-title d-flex justify-content-between align-items-center"
                      >
                        Messages des residents
                        <a href="#" class="small">Marquer tout comme lu</a>
                      </div>
                    </li> --}}
                    {{-- <li>
                      <div class="message-notif-scroll scrollbar-outer">
                        <div class="notif-center">
                          <a href="#">
                            <div class="notif-img">
                              <img
                                src="assets/img/jm_denis.jpg"
                                alt="Img Profile"
                              />
                            </div>
                            <div class="notif-content">
                              <span class="subject">Malik</span>
                              <span class="block">  Comment allez-vous ? </span>
                              <span class="time">Il y a 5 minutes </span>
                            </div>
                          </a>
                          <a href="#">
                            <div class="notif-img">
                              <img
                                src="assets/img/chadengle.jpg"
                                alt="Img Profile"
                              />
                            </div>
                            <div class="notif-content">
                              <span class="subject">Kone</span>
                              <span class="block"> Ok, Mercie ! </span>
                              <span class="time">Il y a 12 minutes</span>
                            </div>
                          </a>
                          <a href="#">
                            <div class="notif-img">
                              <img
                                src="assets/img/mlane.jpg"
                                alt="Img Profile"
                              />
                            </div>
                            <div class="notif-content">
                              <span class="subject">Imirana</span>
                              <span class="block">
                                Et concernant le recyclage
                              </span>
                              <span class="time">Il y a12 minutes </span>
                            </div>
                          </a>
                          <a href="#">
                            <div class="notif-img">
                              <img
                                src="assets/img/talha.jpg"
                                alt="Img Profile"
                              />
                            </div>
                            <div class="notif-content">
                              <span class="subject">Fadi</span>
                              <span class="block"> Salut, Sanya-Service ? </span>
                              <span class="time">Il y a 17 minutes.</span>
                            </div>
                          </a>
                        </div>
                      </div>
                    </li>
                    <li>
                      <a class="see-all" href="javascript:void(0);"
                        >Voir plusieurs messages<i class="fa fa-angle-right"></i>
                      </a>
                    </li> --}}
                  </ul>
                </li>
                <li class="nav-item topbar-icon dropdown hidden-caret">
                      <a
                          class="nav-link dropdown-toggle"
                          href="#"
                          id="notifDropdown"
                          role="button"
                          data-bs-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false"
                      >
                          <i class="fa fa-bell"></i>
                          <!-- Affiche le nombre de notifications non lues -->
                          @if (Auth::check() && Auth::user()->unreadNotifications->count() > 0)
                              <span class="notification">{{ Auth::user()->unreadNotifications->count() }}</span>
                          @endif
                      </a>

                      <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                          <li>
                              <div class="dropdown-title">Vos nouvelles notifications</div>
                          </li>
                          <li>
                              <div class="notif-scroll scrollbar-outer">
                                  <!-- Vérifier si l'utilisateur connecté est une mairie -->
                                  @if (Auth::guard('mairie')->check())
                                      @php
                                          $notifications = Auth::guard('mairie')->user()->unreadNotifications;
                                      @endphp
                                      <ul>
                                          @foreach ($notifications as $notification)
                                              @if (isset($notification->data['signalement_id']))
                                                  <!-- Notification de la mairie pour un nouveau signalement -->
                                                  <li>
                                                      <a href="{{ route('mairie.signalements.show', $notification->data['signalement_id']) }}"
                                                        onclick="event.preventDefault(); document.getElementById('mark-as-read-{{ $notification->id }}').submit();">
                                                          {{ $notification->data['message'] }}
                                                      </a>
                                                      <div class="notif-content">
                                                          <span class="time">{{ $notification->created_at->diffForHumans() }}</span>
                                                      </div>

                                                      <form id="mark-as-read-{{ $notification->id }}" action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST" style="display: none;">
                                                          @csrf
                                                          @method('PATCH')
                                                      </form>
                                                  </li>
                                              @endif
                                          @endforeach
                                      </ul>
                                  @endif

                                  <!-- Vérifier si l'utilisateur connecté est un résident -->
                                  @if (Auth::guard('resident')->check())
                                      @php
                                          $notifications = Auth::guard('resident')->user()->unreadNotifications;
                                      @endphp
                                      <ul>
                                          @foreach ($notifications as $notification)
                                              @if (isset($notification->data['tache_collecte_id']))
                                                  <!-- Notification pour le résident concernant une tâche -->
                                                  <li>
                                                      <a href="{{ route('signalements.index', $notification->data['tache_collecte_id']) }}"
                                                        onclick="event.preventDefault(); document.getElementById('mark-as-read-{{ $notification->id }}').submit();">
                                                          {{ $notification->data['message'] }}
                                                      </a>
                                                      <div class="notif-content">
                                                          <span class="time">{{ $notification->created_at->diffForHumans() }}</span>
                                                      </div>

                                                      <form id="mark-as-read-{{ $notification->id }}" action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST" style="display: none;">
                                                          @csrf
                                                          @method('PATCH')
                                                      </form>
                                                  </li>
                                              @endif
                                          @endforeach
                                      </ul>
                                  @endif
                              </div>
                          </li>
                          <li>
                              <a class="see-all" href="javascript:void(0);">Voir toutes les notifications <i class="fa fa-angle-right"></i></a>
                          </li>
                      </ul>
                  </li>

                 

                <li class="nav-item topbar-user dropdown hidden-caret">
            <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
        <div class="avatar-sm">
            @php
                $guard = null;

                if (Auth::guard('resident')->check()) {
                    $guard = 'resident';
                } elseif (Auth::guard('mairie')->check()) {
                    $guard = 'mairie';
                } elseif (Auth::guard('entreprise')->check()) {
                    $guard = 'entreprise';
                } elseif (Auth::guard('admin')->check()) {
                    $guard = 'admin';
                }

                $compte = $guard ? Auth::guard($guard)->user() : null;
            @endphp
            @if ($compte && $compte->avatar)
                @php
                    // Récupérer le chemin de l'avatar de l'utilisateur connecté
                    $avatarPath = asset('storage/' . $compte->avatar);
                @endphp
                <img
                    src="{{ $avatarPath }}"
                    alt="Avatar"
                    class="avatar-img rounded-circle"
                />
            @else
                <!-- Espace réservé (sans image) si l'utilisateur n'a pas d'avatar -->
                <div class="avatar-img rounded-circle d-flex justify-content-center align-items-center" style="background-color: #f0f0f0; width: 40px; height: 40px;">
                    <i class="fas fa-user" style="color: #a0a0a0; font-size: 20px;"></i>
                </div>
            @endif
        </div>

                    <span class="profile-username">
                      <span class="op-7"></span>
                      <span class="fw-bold">
                                       @php
                                      $guard = null;

                                      if (Auth::guard('resident')->check()) {
                                          $guard = 'resident';
                                      } elseif (Auth::guard('mairie')->check()) {
                                          $guard = 'mairie';
                                      } elseif (Auth::guard('entreprise')->check()) {
                                          $guard = 'entreprise';
                                      } elseif (Auth::guard('admin')->check()) {
                                          $guard = 'admin';
                                      }

                                      $compte = $guard ? Auth::guard($guard)->user() : null;
                                     // dd($compte->admin);
                                  @endphp

                                  @if ($compte)
                                      @if ($guard == 'resident' && $compte->resident)
                                          {{ $compte->resident->prenom_resident }} {{ $compte->resident->nom_resident }}
                                      @elseif ($guard == 'mairie' && $compte->mairie)
                                          {{ $compte->mairie->nom_mairie }}
                                      @elseif ($guard == 'entreprise' && $compte->entreprise)
                                          {{ $compte->entreprise->nom_entreprise }}
                                      @elseif ($guard == 'admin' && $compte->admin)
                                          {{ $compte->admin->prenom }} {{ $compte->admin->nom }}
                                      @else
                                          <span>Type de compte inconnu</span>
                                      @endif
                                  @else
                                      <span>Utilisateur non authentifié</span>
                                  @endif

                          </span>
                    </span>
                  </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <div class="user-box">
                                    <div class="avatar-lg">
                                        @if ($compte && $compte->avatar)
                                            @php
                                                // Récupérer le chemin de l'avatar de l'utilisateur connecté
                                                $avatarPath = asset('storage/' . $compte->avatar);
                                            @endphp
                                            <img
                                                src="{{ $avatarPath }}"
                                                alt="image profile"
                                                class="avatar-img rounded"
                                            />
                                        @else
                                            <!-- Espace réservé (sans image) si l'utilisateur n'a pas d'avatar -->
                                            <div class="avatar-img rounded-circle d-flex justify-content-center align-items-center" style="background-color: #f0f0f0; width: 60px; height: 60px;">
                                                <i class="fas fa-user" style="color: #a0a0a0; font-size: 30px;"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="u-text">
                                        {{-- <a href="#" class="btn btn-xs btn-secondary btn-sm">Voir Profil</a> --}}
                                    </div>
                                </div>
                            </li>
                    <li>
                                            <div class="dropdown-divider"></div>
                                            {{-- <a class="dropdown-item" href="#">Mon Profile</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Parametre du compte</a>
                                            <div class="dropdown-divider"></div> --}}
                                            <form action="{{ route('logout') }}" method="POST">
                                                @csrf
                                                    <button type="submit" class="dropdown-item btn-secondary text-center fw-bold">Se déconnecter</button>
                                                </form>

                                          </li>
                        </div>
                    </ul>

                </li>
              </ul>
            </div>
          </nav>