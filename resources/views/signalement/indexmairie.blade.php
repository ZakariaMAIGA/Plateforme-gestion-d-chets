@extends('master')

@section('content')
<!--div class="container">
    <h1>Signalements Recus par la Mairie</h1>

    @if($signalements->isEmpty())
        <p>Aucun signalement trouvé pour cette mairie.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Type de Problème</th>
                    <th>Description</th>
                    <th>Date du Signalement</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($signalements as $signalement)
                <tr>
                    <td>{{ $signalement->type_probleme }}</td>
                    <td>{{ $signalement->description }}</td>
                    <td>{{ $signalement->date_signalement->format('d/m/Y') }}</td>
                    <td>{{ $signalement->statut }}</td>
                    <td>
                        <a href="{{ route('mairie.signalements.show', $signalement->id) }}" class="btn btn-info">Voir</a>
                        <a href="{{ route('mairie.signalements.changeStatus', $signalement->id) }}" class="btn btn-warning">Changer Statut</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</di-->



<div class="container">
          <div class="page-inner">
             
            <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">La liste des signalements recus</h4>
                    <!--a href="#" class="btn btn-primary btn-round ms-auto">
                        <i class="fa fa-plus"></i>
                        Ajouter
                    </-->
                </div>
            </div>
            <div class="card-body">
                    <!-- Modal -->
   
                   <!-- Display success or error messages -->
                   @if(session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @elseif(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                    <div class="table-responsive">

                    @if($signalements->isEmpty())
                            <p>Vous n'avez aucun signalement merci!.</p>
                      @else
                      <table
                        id="add-row"
                        class="display table table-striped table-hover"
                      >
                     
                        <thead>
                          <tr>
                          <th>Type_probleme</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Statut</th>
                            <th style="width: 10%">Action</th>
                          </tr>
                        </thead>
                         
                        <tbody>
                        @foreach($signalements as $signalement)
                          <tr>
                             <td>{{ $signalement->type_probleme }}</td>
                             <td>{{ $signalement->description }}</td>
                             <td>{{ $signalement->date_signalement->format('d/m/Y') }}</td>
                             <td>
                              
                             <span 
                                @if($signalement->statut == 'en_attente') 
                                    style="color: red;" 
                                @elseif($signalement->statut == 'en_cours') 
                                    style="color: blue;" 
                                @elseif($signalement->statut == 'traite') 
                                    style="color: green;" 
                                @endif
                            >
                                {{ ucfirst($signalement->statut) }}
                            </span>
                              
                             </td>
                             <td>
                              <div class="form-button-action">
                             
                              @php
                               $viewUrl = route('mairie.signalements.show', $signalement->id) ;
                               $editUrl= route('tache.create', ['signalementId' => $signalement->id]);
                               $deleteUrl = route('mairie.signalements.destroy', $signalement->id);
                               @endphp

                               
                               @if($signalement->statut == 'en_cours' || $signalement->statut == 'en_attente' )
                                <button
                                 type="button"
                                 data-bs-toggle="tooltip"
                                 title="Attribuer"
                                 class="btn btn-link btn-primary btn-lg"
                                   onclick="window.location.href='{{ $editUrl }}'">
                                   <i class="fa fa-tasks"></i>
                                </button>
                                
                                @endif
                                <button
                                        type="button"
                                        data-bs-toggle="tooltip"
                                        title="Voir le detail"
                                        class="btn btn-link btn-primary btn-lg"
                                        onclick="window.location.href='{{ $viewUrl }}'">
                                        <i class="fa fa-eye"></i> 
                                </button>
                                <form action="{{$deleteUrl}}" method="POST" style="display:inline-block;">
                                        @csrf
                                    @method('DELETE')
                               

                                        <button
                                       type="submit"
                                  data-bs-toggle="tooltip"
                                     title="Supprimer"
                                    class="btn btn-link btn-danger"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce signalement ?');">
                                      <i class="fas fa-trash-alt"></i>
                                     </button>
                                   
                                     
                                    </form>
                              </div>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                     @endif
                    </div>
                  </div>
                </div>
              </div>
         </div>
        </div>
     </div>


@endsection
