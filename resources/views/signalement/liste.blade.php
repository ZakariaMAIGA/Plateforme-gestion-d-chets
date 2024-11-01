@extends('master')

@section('content')
<div class="container">
          <div class="page-inner">
             
            <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">La liste des signalements</h4>
                    
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
                                    style="background-color: red; color:white;" 
                                @elseif($signalement->statut == 'en_cours') 
                                    style="background-color: blue; color:white;" 
                                @elseif($signalement->statut == 'traite') 
                                    style="background-color: green; color:white;" 
                                @endif
                            >
                                {{ ucfirst($signalement->statut) }}
                            </span>
                             </td>
                             <td>
                              <div class="form-button-action">
                             
                              @php
                               $viewUrl = route('signalements.show', $signalement->id);
                               $editUrl= route('signalements.edit', $signalement->id);
                               $deleteUrl = route('signalements.destroy', $signalement->id);
                               @endphp

                               @if($signalement->statut == 'en_attente')

                                <button
                                 type="button"
                                 data-bs-toggle="tooltip"
                                 title="Modifier"
                                 class="btn btn-link btn-primary btn-lg"
                                   onclick="window.location.href='{{ $editUrl }}'">
                                  <i class="fa fa-edit"></i>
                                </button>
                                @endif

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
                               @if($signalement->statut == 'en_attente')

                                        <button
                                       type="submit"
                                  data-bs-toggle="tooltip"
                                     title="Supprimer"
                                    class="btn btn-link btn-danger"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                                      <i class="fas fa-trash-alt"></i>
                                     </button>
                                     @endif
                                     
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
