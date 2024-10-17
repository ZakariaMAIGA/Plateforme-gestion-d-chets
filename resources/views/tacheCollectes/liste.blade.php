@extends('master')
@section('content')
 
<div class="container">
          <div class="page-inner">
             
            <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">La liste des taches de collectes</h4>
                    <!-- <a href="/equipe/create" class="btn btn-primary btn-round ms-auto">
                        <i class="fa fa-plus"></i>
                        Ajouter
                    </a> -->
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

                    @if($tachesCollectes->isEmpty())
                            <p>Vous n'avez aucune tache de collectes merci!.</p>
                      @else
                      <table
                        id="add-row"
                        class="display table table-striped table-hover"
                      >
                     
                        <thead>
                          <tr>
                          <th>Nom_Equipe</th>
                            <th>Date_Collecte</th>
                            <th>Heure_Collecte</th>
                            <!-- <th>Date_Attribution</th> -->
                            <th>Statut</th>
                            <!-- <th>Type_problème</th> -->
                            <th>Actions</th>
                          </tr>
                        </thead>
                         
                        <tbody>
                        @foreach($tachesCollectes as $tache)
                                <tr>
                                    <td>{{ $tache->nom_equipe }}</td>
                                    <td>{{ \Carbon\Carbon::parse($tache->date_collecte)->format('d/m/Y') }}</td> <!-- Formater la date -->
                                    <td>{{ $tache->heure_collecte }}</td>
                                    <!-- <td>{{ \Carbon\Carbon::parse($tache->date_attribution)->format('d/m/Y') }}</td> -->
                                  
                                     <td>
                                    <span 
                                @if($tache->statut == 'traite') 
                                   style="background-color: green;"
                                @endif
                            >
                                {{ ucfirst($tache->statut) }}
                               </span>
                               </td>
                                    <!-- <td>{{ $tache->type_probleme }}</td> -->
                             <td>
                              <div class="form-button-action">
                             
                              @php
                               $editUrl= route('tache.edit',  $tache->id);
                               $deleteUrl = route('tache.destroy',  $tache->id) ;
                               $viewUrl = route('tache.show', $tache->id);
                               @endphp

                            

                                <button
                                 type="button"
                                 data-bs-toggle="tooltip"
                                 title="Modifier"
                                 class="btn btn-link btn-primary btn-lg"
                                   onclick="window.location.href=' {{$editUrl}}'">
                                  <i class="fa fa-edit"></i>
                                </button>
                                <button
                                        type="button"
                                        data-bs-toggle="tooltip"
                                        title="Voir"
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
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
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