@extends('master')

@section('content')
<div class="container py-5">
  <section class="vh-80" style="background-color: rgb(108, 117, 125);">
    <div class="row d-flex justify-content-center align-items-center h-80">
      <div class="col-lg-8">
        <h2 class="text-center text-white mb-4" style="font-family: 'Roboto', sans-serif; font-weight: 700;">Détails du Signalement</h2>
        <div class="card shadow" style="border-radius: 15px;">
          <div class="card-body p-4">
            <div class="row mb-4">
              <div class="col-md-6">
                <p class="card-text" style="font-family: 'Roboto', sans-serif; font-size: 1.1rem;"><strong style="color: #4CAF50;">Type de Problème :</strong> {{ $signalement->type_probleme }}</p>
                <p class="card-text" style="font-family: 'Roboto', sans-serif; font-size: 1.1rem;"><strong style="color: #4CAF50;">Description :</strong> {{ $signalement->description }}</p>
                <p class="card-text" style="font-family: 'Roboto', sans-serif; font-size: 1.1rem;"><strong style="color: #4CAF50;">Date du Signalement :</strong> {{ $signalement->date_signalement->format('d/m/Y') }}</p>
                <p class="card-text" style="font-family: 'Roboto', sans-serif; font-size: 1.1rem;"><strong style="color: #4CAF50;">Statut :</strong> <span class="badge bg-primary">{{ $signalement->statut }}</span></p>
              </div>
              <div class="col-md-6">
                <p class="card-text" style="font-family: 'Roboto', sans-serif; font-size: 1.1rem;"><strong style="color: #4CAF50;">Signalé par :</strong> {{ $signalement->resident->nom_resident }} {{ $signalement->resident->prenom_resident }}</p>
                <p class="card-text" style="font-family: 'Roboto', sans-serif; font-size: 1.1rem;"><strong style="color: #4CAF50;">Quartier du Résident :</strong> {{ $signalement->resident->adresse }}</p>
                <div class="mt-3">
                  <p><strong style="color: #4CAF50;">Photo du Déchet :</strong></p>
                  <img src="{{ asset('storage/' . $signalement->photo) }}" alt="Photo du Signalement" class="signalement-image">
                </div>
              </div>
            </div>

            <div class="text-center mb-4">
              <button onclick="openItineraire({{ $signalement->latitude }}, {{ $signalement->longitude }})" class="btn btn-info btn-lg" style="font-family: 'Roboto', sans-serif; font-weight: 500;">
                <i class="fas fa-map-marker-alt"></i> Voir la Position
              </button>
            </div>

            <form action="{{ route('mairie.signalements.changeStatus', $signalement->id) }}" method="POST">
              @csrf
              <div class="form-group mb-3">
                <label for="statut" class="form-label" style="font-family: 'Roboto', sans-serif; font-weight: 500;"><strong style="color: #4CAF50;">Changer le Statut</strong></label>
                <select name="statut" id="statut" class="form-select" required>
                  <option value="en_attente" {{ $signalement->statut == 'en_attente' ? 'selected' : '' }}>En Attente</option>
                  <option value="en_cours" {{ $signalement->statut == 'en_cours' ? 'selected' : '' }}>En Cours</option>
                </select>
              </div>

              <div class="d-flex justify-content-between">
                <a href="{{ route('mairie.signalements.index') }}" class="btn btn-secondary">Retour</a>
                <button type="submit" class="btn btn-primary">Mettre à Jour</button>
              </div>
            </form>
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
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    display: block;
    margin: 0 auto;
    max-height: 300px;
    object-fit: cover;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.card-text strong {
    font-family: 'Roboto', sans-serif;
    font-weight: 600;
    font-size: 1.2rem;
    color: #4CAF50;
}
</style>
@endsection
