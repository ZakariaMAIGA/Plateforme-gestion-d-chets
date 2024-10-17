@extends('master')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Créer un nouveau compte</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('comptes.create') }}" method="POST"    enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="nom_user">Nom utilisateur</label>
                                <input type="text" name="nom_user" class="form-control" value="{{ old('nom_user') }}"  placeholder="Entrez votre nom user" required>
                            </div>
                            @error("nom_user")
                                <li class="alert alert-danger">  {{$message}} </li>
                            @enderror
                            
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}"  placeholder="Entrez votre email" required>
                            </div>
                            @error("email")
                               <li class="alert alert-danger">  {{$message}} </li>
                             @enderror
                            
                            <div class="mb-3 form-password-toggle">
                  <label class="form-label" for="password">Mot_de_passe</label>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                       
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                  @error("password")
                    <li class="alert alert-danger">  {{$message}} </li>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="username" class="form-label">Profil</label>
                  <input
                    type="file"
                    class="form-control"
                    id="avatar"
                    name="avatar"
                    accept="image/*" 
                    value="{{ old('avatar') }}" 
                    placeholder="Entrez votre profil"
                    autofocus
                  />
                </div>
                 @error("avatar")
                               <li class="alert alert-danger">  {{$message}} </li>
                 @enderror

                     <div class="form-group">
                                <label for="phone">Téléphone</label>
                                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}"  placeholder="Entrez votre contact" required>
                            </div>
                            @error("phone")
                               <li class="alert alert-danger">  {{$message}} </li>
                             @enderror
                             
                            <div class="form-group">
                                <label for="adresse">Adresse</label>
                                <input type="text" name="adresse" class="form-control" value="{{ old('adresse') }}"  placeholder="Entrez votre adresse" required>
                            </div>
                            @error("adresse")
                               <li class="alert alert-danger">  {{$message}} </li>
                              @enderror

                            <div class="form-group">
                                <label for="type_compte">Type de compte</label>
                                <select name="type_compte" class="form-control" required id="type_compte">
                                    <option value="">Sélectionner un type</option>
                                    @foreach($type_comptes as $type_compte)
                                        <option value="{{ $type_compte->id }}">{{ $type_compte->libelle }}</option>
                                    @endforeach
                                </select>
                            </div>
                              @error("type_compte")
                                  <li class="alert alert-danger">  {{$message}} </li>
                              @enderror

                            <!-- Champs pour Resident -->
                            <div id="resident_fields" style="display: none;">
                                <div class="form-group">
                                    <label for="nom">Nom</label>
                                     <input type="text" name="nom_resident" class="form-control" value="{{ old('nom_resident') }}"  placeholder="Entrez votre nom">
                                </div>
                                @error("nnom_resident")
                                         <li class="alert alert-danger">  {{$message}} </li>
                                @enderror
                                <div class="form-group">
                                    <label for="prenom">Prénom</label>
                                    <input type="text" name="prenom_resident" class="form-control" value="{{ old('prenom_resident') }}"  placeholder="Entrez votre prenom">
                                </div>
                                @error("prenom_resident")
                                    <li class="alert alert-danger">  {{$message}} </li>
                                @enderror
                            </div>

                            <!-- Champs pour Mairie -->
                            <div id="mairie_fields" style="display: none;">
                                <div class="form-group">
                                    <label for="nom_mairie">Nom de la mairie</label>
                                    <input type="text" name="nom_mairie" class="form-control" value="{{ old('nom_mairie') }}">
                                </div>
                                @error("nom_mairie")
                                      <li class="alert alert-danger">  {{$message}} </li>
                                 @enderror
                            
                            
                                <div class="form-group">
                                    <label for="nom_mairie">Commune de la mairie</label>
                                    <input type="text" name="commune" class="form-control" value="{{ old('commune') }}">
                                </div>
                                @error("commune")
                                        <li class="alert alert-danger">  {{$message}} </li>
                                @enderror
                           

                             
                                <div class="form-group">
                                    <label for="nom_mairie">Region de la mairie</label>
                                    <input type="text" name="region" class="form-control" value="{{ old('region') }}">
                                </div>
                                @error("region")
                                       <li class="alert alert-danger">  {{$message}} </li>
                                @enderror
                            </div>

                            <!-- Champs pour Entreprise -->
                            <div id="entreprise_fields" style="display: none;">
                                <div class="form-group">
                                    <label for="nom_entreprise">Nom de l'entreprise</label>
                                    <input type="text" name="nom_entreprise" class="form-control" value="{{ old('nom_entreprise') }}">
                                </div>
                                @error("nom_entreprise")
                                    <li class="alert alert-danger">  {{$message}} </li>
                                @enderror
                                <div class="form-group">
                                    <label for="service">Service</label>
                                    <input type="text" name="service" class="form-control" value="{{ old('service') }}">
                                </div>
                                @error("service")
                                   <li class="alert alert-danger">  {{$message}} </li>
                                @enderror
                            </div>

                            <!-- Champs pour Admin -->
                            <div id="admin_fields" style="display: none;">
                                <div class="form-group">
                                    <label for="nom">Nom</label>
                                    <input type="text" name="nom" class="form-control" value="{{ old('nom') }}">
                                </div>
                                @error("nom")
                                         <li class="alert alert-danger">  {{$message}} </li>
                                @enderror
                                <div class="form-group">
                                    <label for="prenom">Prénom</label>
                                    <input type="text" name="prenom" class="form-control" value="{{ old('prenom') }}">
                                </div> 
                                @error("prenom")
                                    <li class="alert alert-danger">  {{$message}} </li>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Créer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>

document.addEventListener('DOMContentLoaded', function() {
    // Récupérer la valeur du type de compte sélectionné
    var selectedTypeCompte = "{{ old('type_compte') }}";

    // Sélectionner le champ du type de compte
    var typeCompteField = document.querySelector('select[name="type_compte"]');

    if (selectedTypeCompte) {
        // Sélectionner la valeur précédemment sélectionnée
        typeCompteField.value = selectedTypeCompte;

        // Appeler la fonction qui affiche les champs appropriés
        toggleFields(selectedTypeCompte);
    }

    // Ajouter un écouteur d'événements sur le changement du type de compte
    typeCompteField.addEventListener('change', function() {
        toggleFields(this.value);
    });

    function toggleFields(type) {
        // Masquer tous les champs spécifiques
        document.getElementById('resident_fields').style.display = 'none';
        document.getElementById('mairie_fields').style.display = 'none';
        document.getElementById('entreprise_fields').style.display = 'none';
        document.getElementById('admin_fields').style.display = 'none';

        // Afficher les champs en fonction du type de compte sélectionné
        if (type == 1) {
            document.getElementById('resident_fields').style.display = 'block';
        } else if (type == 2) {
            document.getElementById('mairie_fields').style.display = 'block';
        } else if (type == 3) {
            document.getElementById('entreprise_fields').style.display = 'block';
        } else if (type == 4) {
            document.getElementById('admin_fields').style.display = 'block';
        }
    }
});


</script>
@endsection
