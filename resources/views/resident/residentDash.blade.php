

@extends('master')
@section('content')

<div class="container">
          <div class="page-inner">
            <div
              class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
            >
              <div>
                <h3 class="fw-bold mb-3">Dashboard Residents</h3>
                 
              </div>
              <!--div class="ms-md-auto py-2 py-md-0">
                <a href="#" class="btn btn-label-info btn-round me-2">Retour</a>
                <a href="#" class="btn btn-primary btn-round">Voir plus...</a>
              </div-->
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
                      <h4 class="mb-0 text-white">Signals envois </h4>
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
                      <h4 class="mb-0 text-white">Siganls en attente</h4>
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
                      <h4 class="mb-0 text-white">Signals en cours </h4>
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
                      <h4 class="mb-0 text-white">Siganls traités</h4>
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
            <!--div class="row">
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
                          <p class="card-category">Visiteurs</p>
                          <h4 class="card-title">294</h4>
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
                          <h4 class="card-title">103</h4>
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
                          <p class="card-category">Signals</p>
                          <h4 class="card-title">245</h4>
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
                          <h4 class="card-title">89</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div-->
           
            {{-- <div class="row">
              <div class="col-md-12">
                <div class="card card-round">
                  <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                      <h4 class="card-title">Les points de signalements et leurs geolocalisations</h4>
                      <div class="card-tools">
                        <button
                          class="btn btn-icon btn-link btn-primary btn-xs"
                        >
                          <span class="fa fa-angle-down"></span>
                        </button>
                        <button
                          class="btn btn-icon btn-link btn-primary btn-xs btn-refresh-card"
                        >
                          <span class="fa fa-sync-alt"></span>
                        </button>
                        <button
                          class="btn btn-icon btn-link btn-primary btn-xs"
                        >
                          <span class="fa fa-times"></span>
                        </button>
                      </div>
                    </div>
                    <p class="card-category">
                      Veuillez consulter les poinsts de signalements des problemes.
                    </p>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="table-responsive table-hover table-sales">
                          <table class="table">
                            <tbody>
                              <tr>
                                <td>
                                  <div class="flag">
                                  <i class="fas fa-home"></i>
                                  </div>
                                </td>
                                <td>Bamako</td>
                                <td class="text-end">Porte: 320</td>
                                <td class="text-end">Rue: 528</td>
                              </tr>
                              <tr>
                                <td>
                                  <div class="flag">
                                  <i class="fas fa-home"></i>
                                  </div>
                                </td>
                                <td>Koulikoro</td>
                                <td class="text-end">Porte: 435</td>
                                <td class="text-end">Rue: 234</td>
                              </tr>
                               
                              <tr>
                                <td>
                                  <div class="flag">
                                  <i class="fas fa-home"></i>
                                  </div>
                                </td>
                                <td>Segou</td>
                                <td class="text-end">Porte: 756</td>
                                <td class="text-end">Rue: 156</td>
                              </tr>
                              <tr>
                                <td>
                                  <div class="flag">
                                  <i class="fas fa-home"></i>
                                  </div>
                                </td>
                                <td>Kidal</td>
                                <td class="text-end">Porte: 106</td>
                                <td class="text-end">Rue: 324</td>
                              </tr>
                              
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="mapcontainer">
                          <div
                            id="world-map"
                            class="w-100"
                            style="height: 300px"
                          ></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div> --}}
           
          </div>
        </div>
@endsection



    