@extends('master')
@section('content')

<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">La liste des comptes</h4>
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
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Nom User</th>
                                        <th>Email</th>
                                        <th>Telephone</th>
                                        <th>Adresse</th>
                                        <th>Type_compte</th>
                                        <th>Nom</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($comptes as $compte)
                                        <tr>
                                            <td>{{ $compte->nom_user }}</td>
                                            <td>{{ $compte->email }}</td>
                                            <td>{{ $compte->phone }}</td>
                                            <td>{{ $compte->adresse }}</td>
                                            <td>
                                                @if ($compte->resident)
                                                    Résident
                                                @elseif ($compte->mairie)
                                                    Mairie
                                                @elseif ($compte->entreprise)
                                                    Entreprise
                                                    @elseif ($compte->admin)
                                                    Admin
                                                @endif
                                            </td>
                                            <td>
                                                @if ($compte->resident)
                                                    {{ $compte->resident->nom_resident }} {{ $compte->resident->prenom_resident }}
                                                @elseif ($compte->mairie)
                                                    {{ $compte->mairie->nom_mairie }}
                                                @elseif ($compte->entreprise)
                                                    {{ $compte->entreprise->nom_entreprise }}
                                                    @elseif ($compte->admin)
                                                    {{ $compte->admin->nom }} {{ $compte->admin->prenom }}
                                                @endif
                                            </td>
                                            <td>
                                                <div class="form-button-action">
                                                    @php
                                                        $editUrl = route('comptes.edit', $compte->id);
                                                        $deleteUrl = route('comptes.destroy', $compte->id);
                                                        $validateUrl= route('comptes.validate', $compte->id);
                                                    @endphp
                                                    <button type="button" data-bs-toggle="tooltip" title="Modifier" class="btn btn-link btn-primary btn-lg" onclick="window.location.href='{{ $editUrl }}'">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <form action="{{ $deleteUrl }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" data-bs-toggle="tooltip" title="Supprimer" class="btn btn-link btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                     <!--j'ajoute un middlewre qui permet a un admin seul de valider ces types de comptes--->
                                                    @if (($compte->type_compte_id == 2 || $compte->type_compte_id == 3) && !$compte->is_validated)
                                                    <form action="{{   $validateUrl}}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" data-bs-toggle="tooltip" title="Valider" class="btn btn-link btn-success" onclick="return confirm('Êtes-vous sûr de vouloir valider ce compte ?');">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    </form>
                                                @endif
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
