@extends('master')

@section('content')
<!--div class="container">
    <h1>Faire un Signalement</h1>
    <form action="{{ route('signalements.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="type_probleme">Type de Problème</label>
            <input type="text" name="type_probleme" id="type_probleme" class="form-control" required>
        </div>
        @error("type_probleme")
        <li class="alert alert-danger">  {{$message}} </li>
        @enderror

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" required></textarea>
        </div>
        
        @error("description")
        <li class="alert alert-danger">  {{$message}} </li>
        @enderror

        <div class="form-group">
            <label for="photo">Date de signalement</label>
            <input type="date" name="date_signalement" id="date" class="form-control" required>
        </div>
        @error("date_signalement")
        <li class="alert alert-danger">  {{$message}} </li>
        @enderror

        <div class="form-group">
            <label for="photo">Photo</label>
            <input type="file" name="photo" id="photo" class="form-control" required>
        </div>
        @error("phone")
        <li class="alert alert-danger">  {{$message}} </li>
        @enderror
        

        <div class="form-group">
            <label for="mairie_id">Mairie Responsable</label>
            <select name="mairie_id" id="mairie_id" class="form-control" required>
            <option value="">Choisir votre mairie</option>
                @foreach($mairies as $mairie)
                    <option value="{{ $mairie->id }}">{{ $mairie->nom_mairie }}</option>
                @endforeach
            </select>
        </div>
        @error("mairie_id")
        <li class="alert alert-danger">  {{$message}} </li>
        @enderror

        <button type="submit" class="btn btn-primary">Soumettre</button>
    </form>
</div-->

<!-- <div class="container h-90">
  <section class="vh-80" style="background-color:lab(lightness a b);">
    <div class="row d-flex justify-content-center align-items-center h-80">
      <div class="col-xl-9">

        <h2 class="text-black mb-4">Créer un signalement</h2>

        <div class="card" style="border-radius: 15px; color:lab(lightness a b);" >
          <div class="card-body">

            <form action="{{ route('signalements.store') }}" method="POST" enctype="multipart/form-data">
              @csrf

              <div class="row align-items-center pt-4 pb-3">
                <div class="col-md-3 ps-5">
                  <h6 class="mb-0">Type de problème</h6>
                </div>
                <div class="col-md-9 pe-5">
                  <input type="text" id="type_probleme" name="type_probleme" class="form-control form-control-lg" placeholder="Entrez le type de probleme"  required/>
                </div>
              </div>
              @error("type_probleme")
              <li class="alert alert-danger">  {{$message}} </li>
              @enderror

               

              <hr class="mx-n3">

              <div class="row align-items-center py-3">
                <div class="col-md-3 ps-5">
                  <h6 class="mb-0">Description du problème</h6>
                </div>
                <div class="col-md-9 pe-5">
                  <textarea name="description" class="form-control" rows="3" placeholder="Decrire le probleme..." required></textarea>
                </div>
              </div>
              @error("description")
              <li class="alert alert-danger">  {{$message}} </li>
              @enderror

              <hr class="mx-n3">

              <div class="row align-items-center py-3">
                <div class="col-md-3 ps-5">
                  <h6 class="mb-0">Date de signalement</h6>
                </div>
                <div class="col-md-9 pe-5">
                  <input type="date" name="date_signalement" id="date" class="form-control form-control-lg" required/>
                </div>
              </div>
              @error("date_signalement")
              <li class="alert alert-danger">  {{$message}} </li>
              @enderror

              <hr class="mx-n3">

              <div class="row align-items-center py-3">
                <div class="col-md-3 ps-5">
                  <h6 class="mb-0">Télécharger une photo</h6>
                </div>
                <div class="col-md-9 pe-5">
                  <input class="form-control form-control-lg" name="photo" type="file" required/>
                  <div class="small text-muted mt-2">Téléchargez une photo du problème signalé. Taille max 50 MB</div>
                </div>
              </div>
              @error("photo")
              <li class="alert alert-danger">  {{$message}} </li>
              @enderror

              <hr class="mx-n3">

              <div class="row align-items-center py-3">
                <div class="col-md-3 ps-5">
                  <h6 class="mb-0">Mairie Responsable</h6>
                </div>
                <div class="col-md-9 pe-5">
                  <select name="mairie_id" id="mairie_id" class="form-control form-control-lg" required>
                    <option value="">Choisir votre mairie</option>
                    @foreach($mairies as $mairie)
                      <option value="{{ $mairie->id }}">{{ $mairie->nom_mairie }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              @error("mairie_id")
              <li class="alert alert-danger">  {{$message}} </li>
              @enderror

              <hr class="mx-n3">

              <div class="px-5 py-4">
                <button type="submit" class="btn btn-primary btn-lg">Envoyer</button>
              </div>
            </form>

          </div>
        </div>

      </div>
    </div>
  </section>
</div> -->
<!-- <div class="container h-90">
  <section class="vh-80" style="background-color:lab(lightness a b);">
    <div class="row d-flex justify-content-center align-items-center h-80">
      <div class="col-xl-9">

        <h2 class="text-black mb-4">Créer un signalement</h2>

        <div class="card" style="border-radius: 15px; color:lab(lightness a b);" >
          <div class="card-body">

            <form action="{{ route('signalements.store') }}" method="POST" enctype="multipart/form-data">
              @csrf

              <div class="row align-items-center pt-4 pb-3">
                <div class="col-md-3 ps-5">
                  <h6 class="mb-0">Type de problème</h6>
                </div>
                <div class="col-md-9 pe-5">
                  <input type="text" id="type_probleme" name="type_probleme" class="form-control form-control-lg" placeholder="Entrez le type de probleme"  required/>
                </div>
              </div>
              @error("type_probleme")
              <li class="alert alert-danger">  {{$message}} </li>
              @enderror

              <hr class="mx-n3">

              <div class="row align-items-center py-3">
                <div class="col-md-3 ps-5">
                  <h6 class="mb-0">Description du problème</h6>
                </div>
                <div class="col-md-9 pe-5">
                  <textarea name="description" class="form-control" rows="3" placeholder="Decrire le probleme..." required></textarea>
                </div>
              </div>
              @error("description")
              <li class="alert alert-danger">  {{$message}} </li>
              @enderror

              <hr class="mx-n3">

              <div class="row align-items-center py-3">
                <div class="col-md-3 ps-5">
                  <h6 class="mb-0">Date de signalement</h6>
                </div>
                <div class="col-md-9 pe-5">
                  <input type="date" name="date_signalement" id="date" class="form-control form-control-lg" required/>
                </div>
              </div>
              @error("date_signalement")
              <li class="alert alert-danger">  {{$message}} </li>
              @enderror

              <hr class="mx-n3">

              <div class="row align-items-center py-3">
                <div class="col-md-3 ps-5">
                  <h6 class="mb-0">Télécharger une photo</h6>
                </div>
                <div class="col-md-9 pe-5">
                  <input class="form-control form-control-lg" name="photo" type="file" required/>
                  <div class="small text-muted mt-2">Téléchargez une photo du problème signalé. Taille max 50 MB</div>
                </div>
              </div>
              @error("photo")
              <li class="alert alert-danger">  {{$message}} </li>
              @enderror

              <hr class="mx-n3">

              <div class="row align-items-center py-3">
                <div class="col-md-3 ps-5">
                  <h6 class="mb-0">Mairie Responsable</h6>
                </div>
                <div class="col-md-9 pe-5">
                  <select name="mairie_id" id="mairie_id" class="form-control form-control-lg" required>
                    <option value="">Choisir votre mairie</option>
                    @foreach($mairies as $mairie)
                      <option value="{{ $mairie->id }}">{{ $mairie->nom_mairie }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              @error("mairie_id")
              <li class="alert alert-danger">  {{$message}} </li>
              @enderror

              <hr class="mx-n3">

              <!-- Section pour la géolocalisation >
              <div class="row align-items-center py-3">
                <div class="col-md-3 ps-5">
                  <h6 class="mb-0">Localisation</h6>
                </div>
                <div class="col-md-9 pe-5">
                  <!-- Conteneur de la carte avec une taille définie>
                  <div id="map-container" class="mb-3" style="position: relative; height: 300px; border: 2px solid #ccc;">
                    <div id="map" style="height: 100%;"></div>
                  </div>
                  <!-- Champs cachés pour la latitude et longitude >
                  <input type="hidden" name="latitude" id="latitude">
                  <input type="hidden" name="longitude" id="longitude">
                </div>
              </div>

              <hr class="mx-n3">

              <div class="px-5 py-4">
                <button type="submit" class="btn btn-primary btn-lg">Envoyer</button>
              </div>
            </form>

          </div>
        </div>

      </div>
    </div>
  </section>
</div> -->
<div class="container h-90">
  <section class="vh-80" style="background-color:lab(lightness a b);">
    <div class="row d-flex justify-content-center align-items-center h-80">
      <div class="col-xl-9">

        <h2 class="text-black mb-4">Créer un signalement</h2>

        <div class="card" style="border-radius: 15px; color:lab(lightness a b);">
          <div class="card-body">

            <form action="{{ route('signalements.store') }}" method="POST" enctype="multipart/form-data">
              @csrf

              <div class="row align-items-center pt-4 pb-3">
                <div class="col-md-3 ps-5">
                  <h6 class="mb-0">Type de problème</h6>
                </div>
                <div class="col-md-9 pe-5">
                  <input type="text" id="type_probleme" name="type_probleme" class="form-control form-control-lg" placeholder="Entrez le type de problème" required/>
                </div>
              </div>
              @error("type_probleme")
              <li class="alert alert-danger">  {{$message}} </li>
              @enderror

              <hr class="mx-n3">

              <div class="row align-items-center py-3">
                <div class="col-md-3 ps-5">
                  <h6 class="mb-0">Description du problème</h6>
                </div>
                <div class="col-md-9 pe-5">
                  <textarea name="description" class="form-control" rows="3" placeholder="Décrire le problème..." required></textarea>
                </div>
              </div>
              @error("description")
              <li class="alert alert-danger">  {{$message}} </li>
              @enderror

              <hr class="mx-n3">

              <div class="row align-items-center py-3">
                <div class="col-md-3 ps-5">
                  <h6 class="mb-0">Date de signalement</h6>
                </div>
                <div class="col-md-9 pe-5">
                  <input type="date" name="date_signalement" id="date" class="form-control form-control-lg" required/>
                </div>
              </div>
              @error("date_signalement")
              <li class="alert alert-danger">  {{$message}} </li>
              @enderror

              <hr class="mx-n3">

              <div class="row align-items-center py-3">
                <div class="col-md-3 ps-5">
                  <h6 class="mb-0">Télécharger une photo</h6>
                </div>
                <div class="col-md-9 pe-5">
                  <input class="form-control form-control-lg" name="photo" type="file" required/>
                   
                </div>
              </div>
              @error("photo")
              <li class="alert alert-danger">  {{$message}} </li>
              @enderror

              <hr class="mx-n3">

              <div class="row align-items-center py-3">
                <div class="col-md-3 ps-5">
                  <h6 class="mb-0">Mairie Responsable</h6>
                </div>
                <div class="col-md-9 pe-5">
                  <select name="mairie_id" id="mairie_id" class="form-control form-control-lg" required>
                    <option value="">Choisir votre mairie</option>
                    @foreach($mairies as $mairie)
                      <option value="{{ $mairie->id }}">{{ $mairie->nom_mairie }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              @error("mairie_id")
              <li class="alert alert-danger">  {{$message}} </li>
              @enderror

              <hr class="mx-n3">

              <!-- Section pour la géolocalisation avec latitude, longitude et carte -->
              <div class="row align-items-center py-3">
                <div class="col-md-3 ps-5">
                  <h6 class="mb-0">Longitude</h6>
                </div>
                <div class="col-md-9 pe-5">
                  <input type="text" id="latitude" name="latitude" class="form-control form-control-lg" placeholder=" Longitude" required />
                </div>
              </div>

              <div class="row align-items-center py-3">
                <div class="col-md-3 ps-5">
                  <h6 class="mb-0"> Latitude </h6>
                </div>
                <div class="col-md-9 pe-5">
                  <input type="text" id="longitude" name="longitude" class="form-control form-control-lg" placeholder="Latitude" required />
                </div>
              </div>

              <div class="row align-items-center py-3">
                <div class="col-md-12 ps-5">
                  <!-- Conteneur de la carte interactive -->
                  <div id="map" style="height: 400px; border: 2px solid #ccc;"></div>
                </div>
              </div>

              <hr class="mx-n3">

              <div class="px-5 py-4 d-flex justify-content-between">
                <button type="button" id="openGoogleMaps" class="btn btn-secondary btn-lg">Choisir un emplacement</button>
                <button type="submit" class="btn btn-primary btn-lg">Envoyer</button>
            </div>
            </form>

          </div>
        </div>

      </div>
    </div>
  </section>
</div>


@section('maps')

                


<!-- Script pour Google Maps -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCStBoN0Pbm4FrkJd25Tk60g9voypgo64Q&libraries=places"></script>
<script>
        function initMap() {
            // Coordonnées par défaut (Mali) au cas où la géolocalisation échoue
            var defaultLocation = { lat: 12.6392, lng: -8.0029 };

            // Créer la carte centrée sur la position par défaut
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 6,
                center: defaultLocation
            });

            // Créer un marqueur par défaut
            var marker = new google.maps.Marker({
                position: defaultLocation,
                map: map,
                draggable: true // Permet de déplacer le marqueur
            });

            // Mettre à jour les champs cachés avec les coordonnées par défaut
            document.getElementById('latitude').value = defaultLocation.lat;
            document.getElementById('longitude').value = defaultLocation.lng;

            // Fonction pour obtenir la position actuelle
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var currentLocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    // Centrer la carte sur la position actuelle
                    map.setCenter(currentLocation);
                    map.setZoom(15); // Zoom plus rapproché sur la position actuelle

                    // Déplacer le marqueur sur la position actuelle
                    marker.setPosition(currentLocation);

                    // Mettre à jour les champs cachés avec les coordonnées actuelles
                    document.getElementById('latitude').value = currentLocation.lat;
                    document.getElementById('longitude').value = currentLocation.lng;
                }, function() {
                    // En cas d'échec de la géolocalisation, garder la position par défaut
                    alert('La géolocalisation a échoué, la carte restera centrée sur la position par défaut.');
                });
            } else {
                alert('Votre navigateur ne supporte pas la géolocalisation.');
            }

            // Lorsque l'utilisateur clique sur la carte
            map.addListener('click', function(event) {
                var clickedLocation = event.latLng;

                // Déplacer le marqueur à l'emplacement cliqué
                marker.setPosition(clickedLocation);

                // Mettre à jour les champs cachés avec les nouvelles coordonnées
                document.getElementById('latitude').value = clickedLocation.lat();
                document.getElementById('longitude').value = clickedLocation.lng();
            });

            // Lorsque l'utilisateur déplace le marqueur manuellement
            marker.addListener('dragend', function() {
                var draggedLocation = marker.getPosition();

                // Mettre à jour les champs cachés avec les nouvelles coordonnées
                document.getElementById('latitude').value = draggedLocation.lat();
                document.getElementById('longitude').value = draggedLocation.lng();
            });
        }

        // Charger la carte lors du chargement de la page
        google.maps.event.addDomListener(window, 'load', initMap);

        // Fonction pour ouvrir Google Maps dans un nouvel onglet
        document.getElementById('openGoogleMaps').addEventListener('click', function() {
            // URL pour ouvrir Google Maps
            var mapsUrl = `https://www.google.com/maps`;
            window.open(mapsUrl, '_blank');
        });
    </script>


@endsection
   

@endsection