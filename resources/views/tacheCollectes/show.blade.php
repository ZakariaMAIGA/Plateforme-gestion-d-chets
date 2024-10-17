@extends('master')
@section('content')

<div class="container h-90">
  <section class="vh-80" style="background-color: #f8f9fa;">
    <div class="row d-flex justify-content-center align-items-center h-80">
      <div class="col-xl-9">

        <h2 class="text-black mb-4">Détails de la Tâche de Collecte</h2>

        <div class="card" style="border-radius: 15px;">
          <div class="card-body">
            <div class="card-body">
              <p><strong>Nom de l'équipe :</strong>  <td>{{ $tache->equipe->nom }}</td></p>
              <p><strong>Date de Collecte :</strong> {{ \Carbon\Carbon::parse($tache->signalements->first()->pivot->date_collecte)->format('d/m/Y') ?? 'N/A' }}</p>
              
              <p><strong>Heure de Collecte :</strong> {{ $tache->signalements->first()->pivot->heure_collecte ?? 'N/A' }}</p>
              
              <p><strong>Date d'Attribution :</strong> {{ \Carbon\Carbon::parse($tache->date_attribution)->format('d/m/Y') }}</p>
              <p><strong>Statut :</strong>  
                <span 
                  @if($tache->statut == 'traite') 
                      style="background-color: green;"
                  @endif
                >
                  {{ ucfirst($tache->statut) }}
                </span>
              </p>
              <p><strong>Type de problème associé :</strong> {{ $tache->signalements->first()->type_probleme ?? 'N/A' }}</p>
            

              <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Retour</a>
            </div>

          </div>
        </div>

      </div>
    </div>
  </section>
</div>


@endsection