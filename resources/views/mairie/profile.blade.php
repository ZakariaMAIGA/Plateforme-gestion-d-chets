@extends('master')

@section('content')
<div class="container">
    <div class="page-inner py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header text-center">
                        <h1 class="card-title">Mon Profil</h1>
                    </div>
                    <div class="card-body">
                        @if(session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('mairie.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="row mb-4 align-items-center">
                                <!-- Avatar à gauche et nom à droite -->
                                <div class="col-md-3 text-center">
                                    <label for="avatar" class="avatar-label">
                                        <div class="form-group">
                                            @if($compte->avatar)
                                                <img id="avatarPreview" src="{{ asset('storage/' . $compte->avatar) }}" alt="Avatar" class="rounded-circle" width="120" style="cursor: pointer;">
                                            @else
                                                <img id="avatarPreview" src="{{ asset('default-avatar.png') }}" alt="Avatar par défaut" class="rounded-circle" width="120" style="cursor: pointer;">
                                            @endif
                                            <!-- Champ caché pour la sélection du fichier -->
                                            <input type="file" id="avatar" name="avatar" class="d-none">
                                        </div>
                                    </label>
                                </div>
                                
                                <!-- Nom et prénom à droite de l'avatar -->
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="nom_resident">Nom de la marie</label>
                                                <input type="text" class="form-control" name="nom_mairie" value="{{ $compte->mairie->nom_mairie }}" required>
                                            </div>
                                             @error("nom_mairie")
                                      <li class="alert alert-danger">  {{$message}} </li>
                                     @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="prenom_resident">Commune</label>
                                                <input type="text" class="form-control" name="commune" value="{{ $compte->mairie->commune }}" required>
                                            </div>
                                             @error("commune")
                                      <li class="alert alert-danger">  {{$message}} </li>
                                     @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Email et Téléphone côte à côte -->
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" value="{{ $compte->email }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="phone">Téléphone</label>
                                        <input type="text" class="form-control" name="phone" value="{{ $compte->phone }}" required>
                                    </div>
                                     @error("phone")
                                      <li class="alert alert-danger">  {{$message}} </li>
                                     @enderror
                                </div>
                            </div>

                            <div class="row">
                                <!-- Ancien mot de passe avec icône pour afficher le mot de passe -->
                                <div class="col-md-6">
                                    <div class="form-group mb-3 position-relative">
                                        <label for="current_password">Ancien mot de passe</label>
                                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                                        <span toggle="#current_password" class="fa fa-fw fa-eye field-icon toggle-password" style="cursor: pointer; position: absolute; right: 10px; top: 57px; height: 100%; width: 40px;"></span>
                                    </div>
                                     @error("current_password")
                                     <li class="alert alert-danger">  {{$message}} </li>
                                       @enderror
                                </div>
                                    <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="phone">Region</label>
                                        <input type="text" class="form-control" name="region" value="{{ $compte->mairie->region }}" required>
                                    </div>
                                     @error("region")
                                     <li class="alert alert-danger">  {{$message}} </li>
                                       @enderror
                                </div>
                            </div>

                            <div class="row">
                                <!-- Nouveau mot de passe avec icône pour afficher le mot de passe -->
                                <div class="col-md-6">
                                    <div class="form-group mb-3 position-relative">
                                        <label for="password">Nouveau mot de passe</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Laissez vide pour ne pas changer">
                                        <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password" style="cursor: pointer; position: absolute; right: 10px; top: 57px;  height: 100%; width: 40px; "></span>
                                    </div>
                                     @error("password")
                                     <li class="alert alert-danger">  {{$message}} </li>
                                       @enderror
                                </div>
                                
                                <!-- Confirmation du mot de passe avec icône -->
                                <div class="col-md-6">
                                    <div class="form-group mb-3 position-relative">
                                        <label for="password_confirmation">Confirmer mot de passe</label>
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                        <span toggle="#password_confirmation" class="fa fa-fw fa-eye field-icon toggle-password" style="cursor: pointer; position: absolute; right: 10px; top: 57px; height: 100%; width: 40px;"></span>
                                    </div>
                                </div>
                                 @error("password_confirmation")
                                     <li class="alert alert-danger">  {{$message}} </li>
                                       @enderror
                            </div>


                            <!-- Bouton de mise à jour -->
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary px-5">Mettre à jour</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<!-- JavaScript pour rendre l'avatar cliquable -->
@section('scripts')
<script>
    // Lorsque l'utilisateur clique sur l'avatar, le champ input file est déclenché
    document.getElementById('avatarPreview').addEventListener('click', function() {
        document.getElementById('avatar').click();
    });

    // Affiche un aperçu de la nouvelle image sélectionnée
    document.getElementById('avatar').addEventListener('change', function(event) {
        if (event.target.files && event.target.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatarPreview').src = e.target.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    });
</script>

<script>
    document.querySelectorAll('.toggle-password').forEach(item => {
        item.addEventListener('click', function () {
            const input = document.querySelector(this.getAttribute('toggle'));
            if (input.getAttribute('type') === 'password') {
                input.setAttribute('type', 'text');
                this.classList.toggle('fa-eye-slash'); // change l'icône quand on affiche le mot de passe
            } else {
                input.setAttribute('type', 'password');
                this.classList.toggle('fa-eye-slash');
            }
        });
    });
</script>


@endsection

