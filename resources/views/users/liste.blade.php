@extends('master')
@section('content')
<div class="container">
          <div class="page-inner">
             
            <d<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">La liste des utilisateurs</h4>
                    <a href="/create" class="btn btn-primary btn-round ms-auto">
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
                      <table
                        id="add-row"
                        class="display table table-striped table-hover"
                      >
                        <thead>
                          <tr>
                            <th>Prenom</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Telephone</th>
                            <th>Adresse</th>
                            <th>Role</th>
                            <th style="width: 10%">Action</th>
                          </tr>
                        </thead>
                         
                        <tbody>
                        @foreach($users as $user)
                          <tr>
                             <td>{{ $user->prenom }}</td>
                             <td>{{ $user->name }}</td>
                             <td>{{ $user->email }}</td>
                             <td>{{ $user->phone }}</td>
                            <td>{{ $user->adresse }}</td>
                            <td>{{ $user->role }}</td>
                          <td>
                              <div class="form-button-action">
                              @php
                               $editUrl = route('users.edit', $user->id);
                               $deleteUrl = route('users.destroy', $user->id);
                               @endphp
                                <button
                                 type="button"
                                 data-bs-toggle="tooltip"
                                 title="Modifier"
                                 class="btn btn-link btn-primary btn-lg"
                                   onclick="window.location.href='{{ $editUrl }}'">
                                  <i class="fa fa-edit"></i>
                                </button>
                                <form action="{{ $deleteUrl }}" method="POST" style="display:inline-block;">
                                        @csrf
                                    @method('DELETE')
                                        <button
                                       type="submit"
                                  data-bs-toggle="tooltip"
                                     title="Supprimer"
                                    class="btn btn-link btn-danger"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                                   <i class="fa fa-times"></i>
                                     </button>
                                    </form>
                              </div>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
         </div>
        </div>
     </div>



@endsection