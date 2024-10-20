@extends('master')
@section('content')

<div class="container">
          <div class="page-inner">
            <div
              class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
            >
              <div>
                <h3 class="fw-bold mb-3">Dashboard d'administrateurs</h3>
                 
              </div>
              <div class="ms-md-auto py-2 py-md-0">
                {{-- <a href="#" class="btn btn-label-info btn-round me-2">Retour</a>
                <a href="#" class="btn btn-primary btn-round">Voir plus...</a> --}}
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div
                          class="icon-big text-center icon-primary bubble-shadow-small"
                        >
                          <i class="fas fa-users"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category">Comptes</p>
                          <h4 class="card-title">{{ $nombreComptes }}</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div
                          class="icon-big text-center icon-info bubble-shadow-small"
                        >
                        <i class="fas fa-recycle"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category">Services</p>
                          <h4 class="card-title">{{ $nombreServices }}</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div
                          class="icon-big text-center icon-success bubble-shadow-small"
                        >
                        <i class="fas fa-trash-alt"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category">Signalements</p>
                          <h4 class="card-title">{{ $nombreSignalements }}</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div
                          class="icon-big text-center icon-secondary bubble-shadow-small"
                        >
                        <i class="fas fa-tasks"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category">Taches</p>
                          <h4 class="card-title">{{ $nombreTaches }}</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
              <!-- Page header -->
              <div>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="mb-2 mb-lg-0">
                    <h3 class="mb-0 fw-bold text-blue"></h3>
                  </div>
                 
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
              <!-- card -->
              <div class="card rounded-3 bg-dark">
                <!-- card body -->
                <div class="card-body">
                  <!-- heading -->
                  <div class="d-flex justify-content-between align-items-center
                    mb-3">
                    <div>
                      <h4 class="mb-0 text-white">Signals en cours </h4>
                    </div>
                     
                  </div>
                  <!-- project number -->
                  <div>
                     
                    <p class="mb-0"><span class="text-white me-2">{{ $nombreSignalementsEnCours}}</span><span style="color: white;">En cours</span></p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
              <!-- card -->
              <div class="card rounded-3 bg-danger">
                <!-- card body -->
                <div class="card-body">
                  <!-- heading -->
                  <div class="d-flex justify-content-between align-items-center
                    mb-3">
                    <div>
                      <h4 class="mb-0 text-white">Siganls en attentes</h4>
                    </div>
                     
                  </div>
                  <!-- project number -->
                  <div>
                    
                    <p class="mb-0"><span class="text-white me-2">{{$nombreSignalementsEnAttente}}</span> <span class="text-white">En attentes</span></p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
              <!-- card -->
              <div class="card rounded-3 bg-success">
                <!-- card body -->
                <div class="card-body">
                  <!-- heading -->
                  <div class="d-flex justify-content-between align-items-center
                    mb-3">
                    <div>
                      <h4 class="mb-0 text-white"> Siganls traités</h4>
                    </div>
                    
                  </div>
                  <!-- project number -->
                  <div>
            
                   
                     <p class="mb-0"><span class="text-white me-2">{{ $nombreSignalementsTraites}}</span><span style="color: white;">Traités</span></p>
                  </div>
                </div>
              </div>

            </div>
            <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
              <!-- card -->
              <div class="card rounded-3 bg-primary">
                <!-- card body -->
                <div class="card-body">
                  <!-- heading -->
                  <div class="d-flex justify-content-between align-items-center
                    mb-3">
                    <div>
                      <h4 class="mb-0 text-white"> Nombre équipes</h4>
                    </div>
                   
                  </div>
                  <!-- project number -->
                  <div>
                    
                    <p class="mb-0"><span class="text-white me-2">{{$nombreEquipe}}</span> <span class="text-white">Equipes</span></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card card-round">
                  <div class="card-body pb-0">
                    
                    <div class="h1 fw-bold float-end text-primary"></div>
        <h2 class="mb-2">La mairie qui a fait plus de gestion de signalements :<span class="h1 fw-bold  text-primary">  {{ $nomMeilleureMairie}} </span> </h2>
    
        <div class="pull-in sparkline-fix">
                      <div id="lineChart"></div>
                    </div>
                  </div>
          </div>
      </div>
@endsection