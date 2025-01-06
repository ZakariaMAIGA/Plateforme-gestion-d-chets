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
              {{-- <div class="ms-md-auto py-2 py-md-0">
                <a href="#" class="btn btn-label-info btn-round me-2">Retour</a>
                <a href="#" class="btn btn-primary btn-round">Voir plus...</a>
              </div> --}}
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
                    <p class="mb-0"><span class="text-dark me-2"> </span><strong>Reçus</strong></p>
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
                    <p class="mb-0"><span class="text-dark me-2"></span><strong>Attribuées</strong></p>
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
                      <h4 class="mb-0">Productivité</h4>
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
             
            
            <div class="row">
              <div class="col-md-8">
                <div class="card card-round">
                  <div class="card-header">
                    <div class="card-head-row">
                      <div class="card-title">Statistiques des signalements reçus par mois</div>
                      <div class="card-tools">
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
                      <div class="card-title">Nombre signals gérés par mois en ({{ now()->year }})</div>
                      <div class="card-tools">
                        <div class="dropdown">
                         
                        </div>
                      </div>
                    </div>
                    {{-- <div class="card-category">25 Mars - Avril 02</div> --}}
                  </div>
                  <div class="card-body pb-0">
                    <div class="mb-4 mt-2">
                      <ul>
          @foreach ($signalementsParMois as $signalement)
            <li>
              Mois de {{ \Carbon\Carbon::createFromFormat('m', $signalement->mois)->locale('fr')->translatedFormat('F') }} :
              {{ $signalement->total }} signalements traités
            </li>
          @endforeach
        </ul>
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
               
@section('statistics')      
 <script>
//var signalementsData = @json($signalementsData);
//var $signalementsData = [0, 0, 0, 0, 0, 0, 0, 0, 8, 4, 2];
var signalementsData = @json($signalementsData);
console.log(signalementsData);
var ctx = document.getElementById('statisticsChart').getContext('2d');
var statisticsChart = new Chart(ctx, {
	type: 'line',
	data: {
		labels: ["Jan", "Fev", "Mar", "Avr", "Mai", "Jui", "Juil", "Aou", "Sep", "Oct", "Nov", "Dec"],
		datasets: [{
			label: "Signalements reçu par mois",
			borderColor: '#177dff',
			pointBackgroundColor: 'rgba(23, 125, 255, 0.6)',
			pointRadius: 0,
			backgroundColor: 'rgba(23, 125, 255, 0.4)',
			legendColor: '#177dff',
			fill: true,
			borderWidth: 2,
			 data: Object.values(signalementsData)
		}]

	},
	options : {
		responsive: true, 
		maintainAspectRatio: false,
		legend: {
			display: false
		},
		tooltips: {
			bodySpacing: 4,
			mode:"nearest",
			intersect: 0,
			position:"nearest",
			xPadding:10,
			yPadding:10,
			caretPadding:10
		},
		layout:{
			padding:{left:5,right:5,top:15,bottom:15}
		},
		scales: {
			yAxes: [{
				ticks: {
					fontStyle: "500",
					beginAtZero: false,
					maxTicksLimit: 5,
					padding: 10
				},
				gridLines: {
					drawTicks: false,
					display: false
				}
			}],
			xAxes: [{
				gridLines: {
					zeroLineColor: "transparent"
				},
				ticks: {
					padding: 10,
					fontStyle: "500"
				}
			}]
		}, 
		legendCallback: function(chart) { 
			var text = []; 
			text.push('<ul class="' + chart.id + '-legend html-legend">'); 
			for (var i = 0; i < chart.data.datasets.length; i++) { 
				text.push('<li><span style="background-color:' + chart.data.datasets[i].legendColor + '"></span>'); 
				if (chart.data.datasets[i].label) { 
					text.push(chart.data.datasets[i].label); 
				} 
				text.push('</li>'); 
			} 
			text.push('</ul>'); 
			return text.join(''); 
		}  
	}
});

var myLegendContainer = document.getElementById("myChartLegend");

// generate HTML legend
myLegendContainer.innerHTML = statisticsChart.generateLegend();

// bind onClick event to all LI-tags of the legend
var legendItems = myLegendContainer.getElementsByTagName('li');
for (var i = 0; i < legendItems.length; i += 1) {
	legendItems[i].addEventListener("click", legendClickCallback, false);
}

        </script>
        @endsection

          
@endsection