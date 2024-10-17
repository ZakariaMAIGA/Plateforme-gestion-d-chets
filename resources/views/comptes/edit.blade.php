@extends('master')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Modifier l'utilisateur</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('comptes.update', $compte->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="form-group">
                                <label for="nom_user">Nom utilisateur</label>
                                <input type="text" name="nom_user" class="form-control" value="{{ $compte->nom_user }}" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $compte->email }}" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="phone">Téléphone</label>
                                <input type="text" name="phone" class="form-control" value="{{ $compte->phone }}" required>
                            </div>
                             
                            <div class="form-group">
                                <label for="adresse">Adresse</label>
                                <input type="text" name="adresse" class="form-control" value="{{ $compte->adresse }}" required>
                            </div>
                            <div class="form-group">
                                <label for="type_compte">Type de compte</label>
                                <select name="type_compte" class="form-control" required>
                                @foreach($type_comptes as $type_compte)
                                 <option value="{{ $type_compte->id }}" 
                                {{ $compte->typecompte && $compte->typecompte->id == $type_compte->id ? 'selected' : '' }}>
                                {{ $type_compte->libelle }}
                                 </option>
                                @endforeach
                            </select>
                            </div>

                            
                            @if ($compte->resident)
                                <div class="form-group">
                                    <label for="nom">Nom</label>
                                    <input type="text" name="nom_resident" class="form-control" value="{{ $compte->resident->nom_resident }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="prenom">Prénom</label>
                                    <input type="text" name="prenom_resident" class="form-control" value="{{ $compte->resident->prenom_resident }}" required>
                                </div>
                            @elseif ($compte->mairie)
                                <div class="form-group">
                                    <label for="nom">Nom</label>
                                    <input type="text" name="nom_marie" class="form-control" value="{{ $compte->mairie->nom_mairie }}" required>
                                </div>
                            @elseif ($compte->entreprise)
                                <div class="form-group">
                                    <label for="nom_entreprise">Nom de l'entreprise</label>
                                    <input type="text" name="nom_entreprise" class="form-control" value="{{ $compte->entreprise->nom_entreprise}}" required>
                                </div>
                                @elseif ($compte->admin)
                                <div class="form-group">
                                    <label for="nom">Nom</label>
                                    <input type="text" name="nom" class="form-control" value="{{ $compte->admin->nom }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="prenom">Prénom</label>
                                    <input type="text" name="prenom" class="form-control" value="{{ $compte->admin->prenom }}" required>
                                </div>
                            @endif

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
