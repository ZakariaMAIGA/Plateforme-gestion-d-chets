@extends('master')

@section('content')
<div class="container h-90">
  <section class="vh-80" style="background-color: #f7f9fb;">
    <div class="row d-flex justify-content-center align-items-center h-80">
      <div class="col-md-8">

        <h2 class="text-primary mb-4 fw-bold text-center">Créer un signalement</h2>

       <div class="card shadow-lg" style="border-radius: 15px; background-color: #ffffff;">
          <div class="card-body">

            <form action="{{ route('signalements.store') }}" method="POST" enctype="multipart/form-data">
              @csrf

              <div class="row align-items-center pt-4 pb-3">
                <div class="col-md-4 text-center">
                  <h6 class="mb-0 fw-bold">Type de problème</h6>
                </div>
                <div class="col-md-8">
                  <input type="text" id="type_probleme" name="type_probleme" class="form-control" placeholder="Entrez le type de problème" required/>
                </div>
              </div>
              @error("type_probleme")
              <li class="alert alert-danger">{{$message}}</li>
              @enderror

              <hr class="mx-n3">

              <div class="row align-items-center py-3">
                <div class="col-md-4 text-center">
                  <h6 class="mb-0 fw-bold">Description du problème</h6>
                </div>
                <div class="col-md-8">
                  <textarea name="description" class="form-control" rows="2" placeholder="Décrire le problème..." required></textarea>
                </div>
              </div>
              @error("description")
              <li class="alert alert-danger">{{$message}}</li>
              @enderror

              <hr class="mx-n3">

              <div class="row align-items-center py-3">
                <div class="col-md-4 text-center">
                  <h6 class="mb-0 fw-bold">Date de signalement</h6>
                </div>
                <div class="col-md-8">
                  <input type="date" name="date_signalement" id="date" class="form-control" required/>
                </div>
              </div>
              @error("date_signalement")
              <li class="alert alert-danger">{{$message}}</li>
              @enderror

              <hr class="mx-n3">

              <div class="row align-items-center py-3">
                <div class="col-md-4 text-center">
                  <h6 class="mb-0 fw-bold">Photo du déchet</h6>
                </div>
                <div class="col-md-8">
                  <input class="form-control" name="photo" type="file" required/>
                </div>
              </div>
              @error("photo")
              <li class="alert alert-danger">{{$message}}</li>
              @enderror

              <hr class="mx-n3">

              <div class="row align-items-center py-3">
                <div class="col-md-4 text-center">
                  <h6 class="mb-0 fw-bold">Mairie Responsable</h6>
                </div>
                <div class="col-md-8">
                  <select name="mairie_id" id="mairie_id" class="form-control" required>
                    <option value="">Choisir votre mairie</option>
                    @foreach($mairies as $mairie)
                      <option value="{{ $mairie->id }}">{{ $mairie->nom_mairie }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              @error("mairie_id")
              <li class="alert alert-danger">{{$message}}</li>
              @enderror

              <hr class="mx-n3">

              <!-- Section pour la géolocalisation -->
              <div class="row align-items-center py-3">
                <div class="col-md-4 text-center">
                  <h6 class="mb-0 fw-bold">Longitude</h6>
                </div>
                <div class="col-md-8">
                  <input type="text" id="longitude" name="longitude" class="form-control" placeholder="Longitude" required/>
                </div>
              </div>

              <div class="row align-items-center py-3">
                <div class="col-md-4 text-center">
                  <h6 class="mb-0 fw-bold">Latitude</h6>
                </div>
                <div class="col-md-8">
                  <input type="text" id="latitude" name="latitude" class="form-control" placeholder="Latitude" required/>
                </div>
              </div>

              <div class="row align-items-center py-3">
                <div class="col-md-12">
                  <div id="map" style="height: 300px; border: 1px solid #ccc;"></div>
                </div>
              </div>

              <hr class="mx-n3">

              <div class="px-4 py-3 d-flex justify-content-between">
                <button type="button" id="openGoogleMaps" class="btn btn-secondary">Choisir un <i class="bi bi-geo-alt-fill"></i></button>
                <button type="submit" class="btn btn-primary"> <i class="bi bi-send-fill"></i>Envoyer</button>
              </div>
            </form>

          </div>
        </div>

      </div>
    </div>
  </section>
</div>

@section('maps')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCStBoN0Pbm4FrkJd25Tk60g9voypgo64Q&libraries=places"></script>
<script>
    function initMap() {
        var defaultLocation = { lat: 12.6392, lng: -8.0029 };
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 6,
            center: defaultLocation
        });
        var marker = new google.maps.Marker({
            position: defaultLocation,
            map: map,
            draggable: true
        });
        document.getElementById('latitude').value = defaultLocation.lat;
        document.getElementById('longitude').value = defaultLocation.lng;

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var currentLocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                map.setCenter(currentLocation);
                map.setZoom(15);
                marker.setPosition(currentLocation);
                document.getElementById('latitude').value = currentLocation.lat;
                document.getElementById('longitude').value = currentLocation.lng;
            }, function() {
                alert('La géolocalisation a échoué.');
            });
        }

        map.addListener('click', function(event) {
            var clickedLocation = event.latLng;
            marker.setPosition(clickedLocation);
            document.getElementById('latitude').value = clickedLocation.lat();
            document.getElementById('longitude').value = clickedLocation.lng();
        });

        marker.addListener('dragend', function() {
            var draggedLocation = marker.getPosition();
            document.getElementById('latitude').value = draggedLocation.lat();
            document.getElementById('longitude').value = draggedLocation.lng();
        });
    }

    google.maps.event.addDomListener(window, 'load', initMap);

    document.getElementById('openGoogleMaps').addEventListener('click', function() {
        var mapsUrl = `https://www.google.com/maps`;
        window.open(mapsUrl, '_blank');
    });
</script>
@endsection
@endsection
