@extends('master')
@section('content')

<div class="container">
          <div class="page-inner">
            <div
              class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
            >
              <div>
                <h3 class="fw-bold mb-3">Dashboard</h3>
                <h4 class="op-7 mb-2">Suivi et Coordination des dechets</h4>
              </div>
              <div class="ms-md-auto py-2 py-md-0">
                <a href="#" class="btn btn-label-info btn-round me-2">Retour</a>
                <a href="#" class="btn btn-primary btn-round">Voir plus...</a>
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
              <div class="card rounded-3">
                <!-- card body -->
                <div class="card-body">
                  <!-- heading -->
                  <div class="d-flex justify-content-between align-items-center
                    mb-3">
                    <div>
                      <h4 class="mb-0">Signalements </h4>
                    </div>
                    <div class="icon-shape icon-md bg-light-primary text-primary
                      rounded-1">
                      <i class="bi bi-exclamation-circle"></i>
                    </div>
                  </div>
                  <!-- project number -->
                  <div>
                    <h1 class="fw-bold">{{ $nombreTotalSignalements }}</h1>
                    <p class="mb-0"><span class="text-dark me-2"> </span><strong>Recus</strong></p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
              <!-- card -->
              <div class="card rounded-3">
                <!-- card body -->
                <div class="card-body">
                  <!-- heading -->
                  <div class="d-flex justify-content-between align-items-center
                    mb-3">
                    <div>
                      <h4 class="mb-0">TachesAttribues</h4>
                    </div>
                    <div class="icon-shape icon-md bg-light-primary text-primary
                      rounded-1">
                      <i class="bi bi-check-circle"></i> 
                    </div>
                  </div>
                  <!-- project number -->
                  <div>
                    <h1 class="fw-bold">{{$nombreTachesAttribuees}}</h1>
                    <p class="mb-0"><span class="text-dark me-2"></span><strong>Attribuees</strong></p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
              <!-- card -->
              <div class="card rounded-3">
                <!-- card body -->
                <div class="card-body">
                  <!-- heading -->
                  <div class="d-flex justify-content-between align-items-center
                    mb-3">
                    <div>
                      <h4 class="mb-0">Equipes</h4>
                    </div>
                    <div class="icon-shape icon-md bg-light-primary text-primary
                      rounded-1">
                      <i class="bi bi-people"></i>
                    </div>
                  </div>
                  <!-- project number -->
                  <div>
                    <h1 class="fw-bold">{{ $equipesCount }}</h1>
                    <p class="mb-0"><span class="text-dark me-2"> </span><strong>Fonctionelles</strong></p>
                  </div>
                </div>
              </div>

            </div>
            <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
              <!-- card -->
              <div class="card rounded-3">
                <!-- card body -->
                <div class="card-body">
                  <!-- heading -->
                  <div class="d-flex justify-content-between align-items-center
                    mb-3">
                    <div>
                      <h4 class="mb-0">Productivite</h4>
                    </div>
                    <div class="icon-shape icon-md bg-light-primary text-primary
                      rounded-1">
                      <i class="bi bi-bullseye fs-4"></i>
                    </div>
                  </div>
                  <!-- project number -->
                  <div>
                    <h1 class="fw-bold">{{ round($productivite, 2) }}%</h1>
                      <p class="mb-0"><span class="text-success me-2">{{ $nombreSignalementsTraites }}</span> <strong>Gérés sur </strong>{{ $nombreTotalSignalements }} <strong>recus</strong></p>
                     
                  </div>
                </div>
              </div>
            </div>
          </div>
             
            {{-- <h4 class="pb-1 mb-4">Les signalements avec leurs descriptions </h4>
              <div class="row mb-5">
                <div class="col-md">
                  <div class="card mb-3">
                    <div class="row g-0">
                      <div class="col-md-4">
                        <img class="card-img card-img-left" src="assets/img/1.jpg" alt="Img Dechet2" />
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title">Depot illegal</h5>
                          <p class="card-text">
                           Nous vous faisons d'un depot 
                           des dechts dans notre quartier sabalibougou pres de la colline
                
                          </p>
                          <p class="card-text"><small class="text-muted">Il y a 5 mois de cela</small></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <div class="card mb-3">
                    <div class="row g-0">
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title">Poubelle pleine</h5>
                          <p class="card-text">
                            Notre poubelle est pleine, nous avons besoin de service de recyclage aupres de vous.
                          </p>
                          <p class="card-text"><small class="text-muted">Il y a une semaine de cela</small></p>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <img class="card-img card-img-right" src="assets/img/0.jpg" alt="Card image" />
                      </div>
                    </div>
                  </div>
                </div>
                
              </div> --}}
            <div class="row">
              <div class="col-md-8">
                <div class="card card-round">
                  <div class="card-header">
                    <div class="card-head-row">
                      <div class="card-title">Statistiques de la gestion dechets</div>
                      <div class="card-tools">
                        <a
                          href="#"
                          class="btn btn-label-success btn-round btn-sm me-2"
                        >
                          <span class="btn-label">
                            <i class="fa fa-pencil"></i>
                          </span>
                          Expoter
                        </a>
                        <a href="#" class="btn btn-label-info btn-round btn-sm">
                          <span class="btn-label">
                            <i class="fa fa-print"></i>
                          </span>
                          Imprimer
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="chart-container" style="min-height: 375px">
                      <canvas id="statisticsChart"></canvas>
                    </div>
                    <div id="myChartLegend"></div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card card-primary card-round">
                  <div class="card-header">
                    <div class="card-head-row">
                      <div class="card-title">Nombre Total</div>
                      <div class="card-tools">
                        <div class="dropdown">
                          {{-- <button
                            class="btn btn-sm btn-label-light dropdown-toggle"
                            type="button"
                            id="dropdownMenuButton"
                            data-bs-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                          >
                            Export
                          </button> --}}
                          {{-- <div
                            class="dropdown-menu"
                            aria-labelledby="dropdownMenuButton"
                          >
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#"
                              >Something else here</a
                            > 
                          </div> --}}
                        </div>
                      </div>
                    </div>
                    <div class="card-category">25 Mars - Avril 02</div>
                  </div>
                  <div class="card-body pb-0">
                    <div class="mb-4 mt-2">
                      <h1>100</h1>
                    </div>
                    <div class="pull-in">
                      <canvas id="dailySalesChart"></canvas>
                    </div>
                  </div>
                </div>
                <div class="card card-round">
                  <div class="card-body pb-0">
                    
                    <div class="h1 fw-bold float-end text-primary"></div>
        <h2 class="mb-2">Résidents totals  = <span class="h1 fw-bold  text-primary"> {{ $nombreResidentsAvecSignalements }} </span> </h2>
    
        <div class="pull-in sparkline-fix">
                      <div id="lineChart"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            </div>
               
              <!--div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
                <div class="col">
                  <div class="card h-100">
                    <img class="card-img-top" src="assets/img/2.jpg" alt="Card image cap" />
                    <div class="card-body">
                      <h5 class="card-title">Card title</h5>
                      <p class="card-text">
                        This is a longer card with supporting text below as a natural lead-in to additional content.
                        This content is a little bit longer.
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="card h-100">
                    <img class="card-img-top" src="assets/img/4.jpg" alt="Card image cap" />
                    <div class="card-body">
                      <h5 class="card-title">Card title</h5>
                      <p class="card-text">
                        This is a longer card with supporting text below as a natural lead-in to additional content.
                        This content is a little bit longer.
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="card h-100">
                    <img class="card-img-top" src="assets/img/13.jpg" alt="Card image cap" />
                    <div class="card-body">
                      <h5 class="card-title">Card title</h5>
                      <p class="card-text">
                        This is a longer card with supporting text below as a natural lead-in to additional content.
                      </p>
                    </div>
                  </div>
                </div>
                
              </div>
            
          </div>
        </div>

          
@endsection