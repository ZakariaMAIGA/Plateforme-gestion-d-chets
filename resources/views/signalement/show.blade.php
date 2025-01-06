@extends('master')

@section('content')

<div class="container h-90">
  <section class="vh-80" style="background-color: #f8f9fa;">
    <div class="row d-flex justify-content-center align-items-center h-80">
      <div class="col-xl-9">

        <h2 class="text-center text-black mb-4" style="font-family: 'Roboto', sans-serif; font-weight: 700;">Détails du Signalement</h2>

        <div class="card" style="border-radius: 15px;">
          <div class="card-body">
            <div class="card-body">
             <p ><strong style="font-size: 1.2rem; color: blue; margin-bottom: 1.5rem;">Type de problème :</strong> <span>{{ $signalement->type_probleme }}</span></p>
              <p ><strong style="font-size: 1.2rem; color: blue; margin-bottom: 1.5rem;">Description :</strong> {{ $signalement->description }}</p>
              <p><strong style="font-size: 1.2rem; color: blue; margin-bottom: 1.5rem;">Date de Signalement :</strong> {{ $signalement->date_signalement->format('d/m/Y') }}</p>
              <p> <strong style="color: blue;"> Statut :</strong> <span style="padding: 5px 15px; border-radius: 5px; color: #fff; font-weight: bold; 
                                @if($signalement->statut == 'en_attente') 
                                    background-color: red; 
                                @elseif($signalement->statut == 'en_cours') 
                                    background-color: blue;  
                                @elseif($signalement->statut == 'traite') 
                                    background-color: green; 
                                @endif">
                                {{ ucfirst($signalement->statut) }}
                            </span></p>
              <p><strong style="font-size: 1.2rem; color: blue; margin-bottom: 1.5rem;">Mairie Responsable :</strong> {{ $signalement->mairie->nom_mairie }}</p>

              <div class="form-group mt-3">
                <p><strong style="font-size: 1.2rem; color: blue; margin-bottom: 1.5rem;">Photo du déchet :</strong></p>
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
 
