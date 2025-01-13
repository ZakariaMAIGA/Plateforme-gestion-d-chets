

@extends('master')
@section('content')

<div class="container">
          <div class="page-inner">
            <div
              class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
            >
              <div>
                <h3 class="fw-bold mb-3">Dashboard Résidents</h3>
                 
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
              <div class="card rounded-3 bg-primary text-white">
                <!-- card body -->
                <div class="card-body">
                  <!-- heading -->
                  <div class="d-flex justify-content-between align-items-center
                    mb-3">
                    <div>
                      <h4 class="mb-0 text-white fw-bold">Signals envoyés </h4>
                    </div>
                     
                  </div>
                  <!-- project number -->
                  <div>
                     
                    <p class="mb-0"><span class="text-white me-2">{{ $signalementsCount}}</span><span class="text-white">envois</span></p>
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
                      <h4 class="mb-0 text-white fw-bold">Signals en attente</h4>
                    </div>
                     
                  </div>
                  <!-- project number -->
                  <div>
                    
                    <p class="mb-0"><span class="text-white me-2"> {{$nombreSignalementsAttente}}</span><span style="color: white;">en attente</span></p>
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
                      <h4 class="mb-0 text-white fw-bold">Signals en cours </h4>
                    </div>
                    
                  </div>
                  <!-- project number -->
                  <div>
            
                    <p class="mb-0"><span class="text-white me-2">{{ $nombreSignalementsCours}}</span><span style="color: white;">en cours</span></p>
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
                      <h4 class="mb-0 text-white fw-bold">Signals traités</h4>
                    </div>
                   
                  </div>
                  <!-- project number -->
                  <div>
                    
                    <p class="mb-0"><span class="text-white me-2">{{$nombreSignalementsTraite}}</span><span style="color:white;">traités</span> </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
            
           
          </div>
        </div>
@endsection



    