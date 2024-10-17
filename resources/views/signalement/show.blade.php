@extends('master')

@section('content')
<!--div class="container">
    <h1>Détails du Signalement</h1>

    <div class="card">
        <div class="card-header">
            <p><strong>Type de probleme :</strong>{{ $signalement->type_probleme }}</p>
        </div>
        <div class="card-body">
            <p><strong>Description :</strong> {{ $signalement->description }}</p>
            <p><strong>Date de Signalement :</strong> {{ $signalement->date_signalement->format('d/m/Y') }}</p>
            <p><strong>Statut :</strong> {{ ucfirst($signalement->statut) }}</p>
            <p><strong>Mairie Responsable :</strong> {{ $signalement->mairie->nom_mairie }}</p>
           

            <div class="form-group">
                <p><strong>Photo du dechet :</strong></p>
                <img src="{{ asset('storage/' . $signalement->photo) }}" alt="Photo du Signalement"  class="signalement-image" >
            </div>

            <a href="{{ route('signalements.index') }}" class="btn btn-primary mt-3">Retour à mes Signalements</a>
        </div>
    </div>
</div-->
 

<div class="container h-90">
  <section class="vh-80" style="background-color: #f8f9fa;">
    <div class="row d-flex justify-content-center align-items-center h-80">
      <div class="col-xl-9">

        <h2 class="text-black mb-4">Détails du Signalement</h2>

        <div class="card" style="border-radius: 15px;">
          <div class="card-body">
            <div class="card-body">
            <p><strong>Type de problème :</strong> {{ $signalement->type_probleme }}</p>
              <p><strong>Description :</strong> {{ $signalement->description }}</p>
              <p><strong>Date de Signalement :</strong> {{ $signalement->date_signalement->format('d/m/Y') }}</p>
              <p><strong>Statut :</strong>  <span 
                                @if($signalement->statut == 'en_attente') 
                                    style="background-color: red;" 
                                @elseif($signalement->statut == 'en_cours') 
                                    style="background-color: blue;" 
                                @elseif($signalement->statut == 'traite') 
                                    style="background-color: green;" 
                                @endif
                            >
                                {{ ucfirst($signalement->statut) }}
                            </span></p>
              <p><strong>Mairie Responsable :</strong> {{ $signalement->mairie->nom_mairie }}</p>

              <div class="form-group mt-3">
                <p><strong>Photo du déchet :</strong></p>
                <img src="{{ asset('storage/' . $signalement->photo) }}" alt="Photo du Signalement" class="signalement-image">
              </div>

              <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Retour</a>
            </div>

          </div>
        </div>

      </div>
    </div>
  </section>
</div>

@endsection

@section('image')
<style>
.signalement-image {
        max-width: 100%; /* Limite la largeur de l'image à celle de son conteneur */
        height: auto;    /* Ajuste la hauteur pour maintenir le ratio */
        border-radius: 8px; /* Coins arrondis pour l'image */
        display: block;  /* Centrer l'image horizontalement */
        margin: 0 auto;  /* Marges automatique pour centrer l'image */
        max-height: 300px; /* Hauteur maximale pour éviter que l'image soit trop grande */
        object-fit: cover; /* Ajuste l'image pour couvrir le conteneur sans déformation */
        width: 300px;
    }
 
</style>
@endsection
 
