<!-- resources/views/tacheCollecte/create.blade.php -->

@extends('master')

@section('content')
<div class="container">
<section class="h-100 h-custom" style="background-color: #8fc4b7;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-8 col-xl-6">
        <div class="card rounded-3">
          <div class="card-body p-4 p-md-5">
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Formulaire de Création de Tâche</h3>

            <form action="{{ route('tache.store') }}" method="POST" class="px-md-2">
              @csrf
              <input type="hidden" name="signalement_id" value="{{ $signalement->id }}">

              <!-- Sélection d'équipe -->
              <div class="form-outline mb-4">
                <label for="equipe_id" class="form-label">Sélectionner une équipe</label>
                <select name="equipe_id" id="equipe_id" class="form-select">
                  <option selected disabled>Choisir l'équipe</option>
                  @foreach($equipes as $equipe)
                    <option value="{{ $equipe->id }}">{{ $equipe->nom }}</option>
                  @endforeach
                </select>
              </div>

              <!-- Date de collecte -->
              <div class="form-outline mb-4">
                <label for="date_collecte" class="form-label">Date de collecte</label>
                <input type="date" name="date_collecte" id="date_collecte" class="form-control" />
                
              </div>

              <!-- Heure de collecte -->
              <div class="form-outline mb-4">
                <label for="heure_collecte" class="form-label">Heure de collecte</label>
                <input type="time" name="heure_collecte" id="heure_collecte" class="form-control" />
                
              </div>

              <!-- Bouton de soumission -->
              <button type="submit" class="btn btn-success btn-lg mb-1">Créer la tâche de collecte</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
@endsection
