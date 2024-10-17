@extends('master')
@section('content')
<div class="container mt-5">
<div class="container mt-5">
    <h2 class="text-center mb-4">Modifier un Service de Recyclage</h2>
<form action="{{ route('services.update', $service->id) }}" method="POST">
    @csrf
    @method('PUT') <!-- Utiliser PUT pour la mise à jour -->

    <div class="card shadow mx-auto" style="max-width: 500px;">
        <div class="card-header text-white" style="background-color: #007bff;">
            <h4 class="mb-0 text-center" style="color: #fff;">Modifier le Service</h4>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" placeholder="Entrez une description du service" required>{{ old('description', $service->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="type_materiau">Type de Matériau</label>
                <input type="text" name="type_materiau" class="form-control" placeholder="Exemple : Plastique, Papier, etc." value="{{ old('type_materiau', $service->type_materiau) }}" required>
            </div>

            <div class="form-group">
                <label for="methode_collecte">Méthode de Collecte</label>
                <input type="text" name="methode_collecte" class="form-control" placeholder="Indiquez la méthode de collecte" value="{{ old('methode_collecte', $service->methode_collecte) }}" required>
            </div>
        </div>
       <div class="card-footer d-flex justify-content-between"> <!-- Alignement des boutons -->
                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Enregistrer
                </button>
            </div>

    </div>
</form>
</div>
</div>

@endsection