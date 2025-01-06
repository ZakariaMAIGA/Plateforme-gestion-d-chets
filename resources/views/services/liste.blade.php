@extends('master')

@section('content')
 
    <div class="container">
    <h2 class="text-center mb-5 fw-bold">Annuaire des services de recyclage</h2>

    <!-- Grid pour les cartes -->
    <style>
        .annuaire-section {
            background-color: #f9f9f9; /* Arrière-plan gris clair */
        }
  .card {
            transition: transform 0.3s ease, background-color 0.3s ease;
            /* Réduction de la taille de la carte */
            min-height: 250px; /* Hauteur minimale de la carte */
            margin: 10px; /* Espace autour des cartes */
            border-radius: 10px; /* Coins arrondis */
        }

        .card:hover {
            transform: translateY(-10px);
            background-color: #f0f0f0; /* Change de couleur au survol */
        }

        /* Style pour les textes dans les cartes */
        .card-text {
            color: black; /* Texte dynamique en noir */
            font-size: 14px; /* Taille de police réduite */
        }

        .card-text strong {
            color: blue; /* Texte statique en bleu */
        }

        /* Réduction de la taille de l'en-tête de la carte */
        .card-header h5 {
            font-size: 16px; /* Taille de police réduite pour le titre */
        }

        /* Style pour les icônes d'édition et de suppression */
        .action-icons {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .action-icons a {
            color: #28a745; /* Couleur pour les icônes (vert) */
            margin-right: 10px;
        }

        .action-icons a:hover {
            color: #dc3545; /* Couleur rouge au survol */
        }
      
      /* Nouvel ajout*/
      .card {
        transition: transform 0.3s ease, background-color 0.3s ease;
        min-height: 250px; 
        margin: 10px; 
        border-radius: 10px;
        background-image: url('{{ asset('assets/img/service4.png')}}'); /* Utilisation de la fonction asset() */
        background-size: cover; 
        background-position: center; 
        color: white; 
    }

    .card:hover {
        transform: translateY(-10px);
        background-color: rgba(0, 0, 0, 0.5);
    }

    .card-header, .card-footer {
        background-color: rgba(40, 167, 69, 0.8);
    }

    .card-body {
        background-color: rgba(255, 255, 255, 0.7);
    }
        
    </style>

    <div class="row">
        @foreach($services as $service)
            <div class="col-md-4 mb-4">
                <!-- Carte Bootstrap avec plus de design -->
                <div class="card h-100 shadow-lg border-0">
                    <div class="card-header text-white" style="background-color:  #004466;">
                        <h5 class="card-title mb-0 text-white text-center">{{ $service->entreprise->nom_entreprise }}</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><i class="fas fa-info-circle"></i> <strong>Description :</strong> {{ $service->description }}</p>
                        <p class="card-text"><i class="fas fa-recycle"></i> <strong>Type de Matériau :</strong> {{ $service->type_materiau }}</p>
                        <p class="card-text"><i class="fas fa-truck"></i> <strong>Méthode de Collecte :</strong> {{ $service->methode_collecte }}</p>
                        <p class="card-text"><i class="fas fa-cogs"></i> <strong>Service :</strong> {{ $service->entreprise->service }}</p>
                        <p class="card-text"><i class="fas fa-map-marker-alt"></i> <strong>Lieu :</strong> {{ $service->entreprise->adresse }}</p>
                        <p class="card-text"><i class="fas fa-phone"></i> <strong>Contact :</strong> {{ $service->entreprise->compte->phone }}</p>

                        <!-- Icônes pour la modification et la suppression -->
                        @if(Auth::guard('entreprise')->check() && Auth::guard('entreprise')->user()->entreprise && Auth::guard('entreprise')->user()->entreprise->id == $service->entreprise->id)
                        <div class="action-icons">
                            <a href="{{ route('services.edit', $service->id) }}" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="#" title="Supprimer" 
                               onclick="event.preventDefault(); if(confirm('Êtes-vous sûr de vouloir supprimer ce service ?')) { document.getElementById('delete-form-{{ $service->id }}').submit(); }">
                                <i class="fas fa-trash"></i>
                            </a>
                            <form id="delete-form-{{ $service->id }}" action="{{ route('services.destroy', $service->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    @endif
                    </div>
                <div class="card-footer" style="background-color: #f8f9fa; border-top: 1px solid #28a745;">
                    <small class="text-muted">
                        <i class="fas fa-building"></i> Service proposé par {{ $service->entreprise->nom_entreprise }}
                    </small>
                </div>

                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection


