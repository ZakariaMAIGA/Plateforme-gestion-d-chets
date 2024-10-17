@extends('master')

@section('content')
<!--div class="container">
    <h1>Editer le Signalement</h1>
    <form action="{{ route('signalements.update', $signalement->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="type_probleme">Type de Problème</label>
            <input type="text" name="type_probleme" id="type_probleme" class="form-control" value="{{ $signalement->type_probleme }}" required>
        </div>
        @error('type_probleme')
        <li class="alert alert-danger">{{ $message }}</li>
        @enderror

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" required>{{ $signalement->description }}</textarea>
        </div>
        @error('description')
        <li class="alert alert-danger">{{ $message }}</li>
        @enderror

        <div class="form-group">
            <label for="mairie_id">Mairie Responsable</label>
            <select name="mairie_id" id="mairie_id" class="form-control" required>
                @foreach($mairies as $mairie)
                    <option value="{{ $mairie->id }}" {{ $signalement->mairie_id == $mairie->id ? 'selected' : '' }}>{{ $mairie->nom_mairie }}</option>
                @endforeach
            </select>
        </div>
        @error('mairie_id')
        <li class="alert alert-danger">{{ $message }}</li>
        @enderror

        <div class="form-group">
            <label for="date_signalement">Date du Signalement</label>
            <input type="date" name="date_signalement" id="date_signalement" class="form-control" value="{{ $signalement->date_signalement->format('Y-m-d') }}" required>
        </div>
        @error('date_signalement')
        <li class="alert alert-danger">{{ $message }}</li>
        @enderror

        <div class="form-group">
            <label for="photo">Photo actuelle</label><br>
            <img src="{{ asset('storage/' . $signalement->photo) }}" alt="Photo du signalement" class="img-fluid" style="max-width: 200px;">
        </div>

        <div class="form-group">
            <label for="photo">Changer la photo (facultatif)</label>
            <input type="file" name="photo" id="photo" class="form-control">
        </div>
        @error('photo')
        <li class="alert alert-danger">{{ $message }}</li>
        @enderror

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div-->


<div class="container h-90">
  <section class="vh-80" style="background-color: #f8f9fa;">
    <div class="row d-flex justify-content-center align-items-center h-80">
      <div class="col-xl-9">

        <h2 class="text-blue mb-4">Editer un signalement</h2>

        <div class="card" style="border-radius: 15px;">
          <div class="card-body">

          <form action="{{ route('signalements.update', $signalement->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')

              <div class="row align-items-center pt-4 pb-3">
                <div class="col-md-3 ps-5">
                  <h6 class="mb-0">Type de problème</h6>
                </div>
                <div class="col-md-9 pe-5">
                  <input type="text" id="type_probleme" name="type_probleme" class="form-control form-control-lg" placeholder="Entrez le type de probleme" value="{{ $signalement->type_probleme }}"  required/>
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
                  <textarea name="description" class="form-control" rows="3" placeholder="Decrire le probleme..."    required>{{ $signalement->description }}</textarea>
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
                  <input type="date" name="date_signalement" id="date" class="form-control form-control-lg"  value="{{ $signalement->date_signalement->format('Y-m-d') }}" required/>
                </div>
              </div>
              @error("date_signalement")
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
                    <option value="{{ $mairie->id }}" {{ $signalement->mairie_id == $mairie->id ? 'selected' : '' }}>{{ $mairie->nom_mairie }}</option>
                @endforeach
                  </select>
                </div>
              </div>
              @error("mairie_id")
              <li class="alert alert-danger">  {{$message}} </li>
              @enderror


              <hr class="mx-n3">

              <div class="form-group">
            <label for="photo">Photo actuelle</label><br>
            <img src="{{ asset('storage/' . $signalement->photo) }}" alt="Photo du signalement" class="img-fluid" style="max-width: 200px;">
            </div>
            <div class="form-group">
            <label for="photo">Changer la photo (facultatif)</label>
            <input type="file" name="photo" id="photo" class="form-control">
          </div>
           @error('photo')
           <li class="alert alert-danger">{{ $message }}</li>
            @enderror

              
            <div class="d-flex justify-content-between px-5 py-4">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Retour</a>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
              </div>
            </form>

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
