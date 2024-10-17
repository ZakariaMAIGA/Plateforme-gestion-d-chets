@extends('master')

@section('content')
<div class="container">
          <div class="page-inner">
             
            <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">La liste des equipes</h4>
                    <a href="/equipe/create" class="btn btn-primary btn-round ms-auto">
                        <i class="fa fa-plus"></i>
                        Ajouter
                    </a>
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

                    @if($equipes->isEmpty())
                            <p>Vous n'avez aucune epuipe merci!.</p>
                      @else
                      <table
                        id="add-row"
                        class="display table table-striped table-hover"
                      >
                     
                        <thead>
                          <tr>
                          <th>Nom de l'equipe</th>
                            <th>Telephone</th>
                            <th>Adresse</th>
                            <th style="width: 10%">Action</th>
                          </tr>
                        </thead>
                         
                        <tbody>
                        @foreach($equipes as $equipe)
                          <tr>
                             <td>{{ $equipe->nom}}</td>
                             <td>{{ $equipe->phone }}</td>
                             <td>{{ $equipe->adresse}}</td>
                    
                             <td>
                              <div class="form-button-action">
                             
                              @php
                               $editUrl= route('equipe.edit', $equipe->id);
                               $deleteUrl = route('equipe.destroy', $equipe->id);
                               @endphp

                            

                                <button
                                 type="button"
                                 data-bs-toggle="tooltip"
                                 title="Modifier"
                                 class="btn btn-link btn-primary btn-lg"
                                   onclick="window.location.href='{{ $editUrl }}'">
                                  <i class="fa fa-edit"></i>
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
