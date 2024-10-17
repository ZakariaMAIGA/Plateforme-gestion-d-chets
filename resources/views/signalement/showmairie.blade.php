@extends('master')

@section('content')
<!--div class="container">
    <h1>Détails du Signalement</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"> <strong>Type de Problème:</strong>  {{ $signalement->type_probleme }}</h5>
            <p class="card-text"> <strong>Description:</strong> {{ $signalement->description }}</p>
            <p class="card-text"> <strong>Statut:</strong>  {{ $signalement->statut }}</p>
            <p class="card-text"><strong> Signalé par:</strong> {{ $signalement->resident->nom_resident }} {{ $signalement->resident->prenom_resident }}</p>
            <p class="card-text"><strong>Quartier du resident:</strong> {{ $signalement->resident->adresse }} </p>


            <div class="form-group">
                <p><strong>Photo du dechet :</strong></p>
                <img src="{{ asset('storage/' . $signalement->photo) }}" alt="Photo du Signalement"  class="signalement-image" >
         </div>

            <form action="{{ route('mairie.signalements.changeStatus', $signalement->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="statut">Changer le Statut</label>
                    <select name="statut" id="statut" class="form-control" required>
                        <option value="en_cours" {{ $signalement->statut == 'en_cours' ? 'selected' : '' }}>En Cours</option>
                        <option value="en_attente" {{ $signalement->statut == 'en_attente' ? 'selected' : '' }}>En Attente</option>
                        <option value="traite" {{ $signalement->statut == 'traite' ? 'selected' : '' }}>Traité</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Approuver</button>
            </form>
        </div>
    </div>
</div-->



<div class="container h-90">
  <section class="vh-80" style="background-color: #f8f9fa;">
    <div class="row d-flex justify-content-center align-items-center h-80">
      <div class="col-xl-9">
        <h2 class="text-black mb-4">Détails du Signalement reçu</h2>
        <div class="card" style="border-radius: 15px;">
          <div class="card-body">
            <div class="card-body">
              <p class="card-text"><strong>Type de Problème:</strong> {{ $signalement->type_probleme }}</p>
              <p class="card-text"><strong>Description:</strong> {{ $signalement->description }}</p>
              <p class="card-text"><strong>Date du signalement:</strong> {{ $signalement->date_signalement->format('d/m/Y') }}</p>
              <p class="card-text"><strong>Statut:</strong> {{ $signalement->statut }}</p>
              <p class="card-text"><strong>Signalé par:</strong> {{ $signalement->resident->nom_resident }} {{ $signalement->resident->prenom_resident }}</p>
              <p class="card-text"><strong>Quartier du résident:</strong> {{ $signalement->resident->adresse }}</p>
              <div class="form-group">
                <p><strong>Photo du déchet :</strong></p>
                <img src="{{ asset('storage/' . $signalement->photo) }}" alt="Photo du Signalement" class="signalement-image">
              </div>
              
              <!-- Bouton pour ouvrir l'itinéraire -->
              <div class="form-group">
                <button onclick="openItineraire({{ $signalement->latitude }}, {{ $signalement->longitude }})" class="btn btn-info">
                  Voir la position
                </button>
              </div>
              
              <form action="{{ route('mairie.signalements.changeStatus', $signalement->id) }}" method="POST">
                @csrf
                <div class="form-group">
                  <label for="statut">Changer le Statut</label>
                  <select name="statut" id="statut" class="form-control" required>
                    <option value="en_cours" {{ $signalement->statut == 'en_attente' ? 'selected' : '' }}>En Attente</option>
                    <option value="en_attente" {{ $signalement->statut == 'en_cours' ? 'selected' : '' }}>En Cours</option>
                  </select>
                </div>
                <div class="row">
                  <div class="col text-start">
                    <a href="{{ route('mairie.signalements.index') }}" class="btn btn-secondary mt-3">Retour</a>
                  </div>
                  <div class="col text-end">
                    <button type="submit" class="btn btn-primary mt-3">Prouver</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- Script pour la géolocalisation et l'itinéraire -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCStBoN0Pbm4FrkJd25Tk60g9voypgo64Q&libraries=places"></script>
<script>
function openItineraire(lat, lng) {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var userLat = position.coords.latitude;
            var userLng = position.coords.longitude;

            // URL pour ouvrir Google Maps avec l'itinéraire
            var mapsUrl = `https://www.google.com/maps/dir/?api=1&origin=${userLat},${userLng}&destination=${lat},${lng}`;
            window.open(mapsUrl, '_blank');
        }, function() {
            alert('Impossible de récupérer votre position actuelle.');
        });
    } else {
        alert('La géolocalisation n\'est pas prise en charge par ce navigateur.');
    }
}
</script>

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
 


  

