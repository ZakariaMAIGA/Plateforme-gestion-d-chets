@extends('master')
@section('content')

<div class="container">
          <div class="page-inner">
            <div
              class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
            >
              <div>
                <h3 class="fw-bold mb-3">Dashboard Entreprise!</h3>
                <h4 class="op-7 mb-2"> </h4>
              </div>
              
            </div>
              

              <div class="row justify-content-center">
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

    <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6 mx-5">
        <!-- card 1 -->
        <div class="card rounded-3 bg-primary text-white">
            <!-- card body -->
            <div class="card-body">
                <!-- heading -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h4 class="mb-0 text-white">Nos clients</h4>
                    </div>
                </div>
                <!-- project number -->
                <div>
                    <p class="mb-0"><span class="text-white me-2">{{$residentsCount }}</span><span style="color: White;">Clients</span></p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6 mx-5">
        <!-- card 2 -->
        <div class="card rounded-3 custom-bg-color">
            <!-- card body -->
            <div class="card-body">
                <!-- heading -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h4 class="mb-0 text-white" >Nos services</h4>
                    </div>
                </div>
                <!-- project number -->
                <div>
                    <p class="mb-0"><span class="text-white me-2">{{ $servicesCount }}</span><span style="color: white;">services</span></p>
                </div>
            </div>
        </div>
        <style>
        .custom-bg-color {
            background-color: #343a40; /* Couleur de fond sombre */
            color: white; /* Texte blanc */
            }
</style>
    </div>
 </div>
 </div>
</div>
@endsection