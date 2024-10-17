@extends('master')
@section('content')
 
@section('script')
<script src="{{asset('vendors/scripts/core.js')}}"></script>
@endsection
<div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="brand-logo">
				<a href="login.html">
					<img src="vendors/images/deskapp-logo.svg" alt="">
				</a>
			</div>
			<div class="login-menu">
				<ul>
					<li><a href="login.html">Login</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="register-page-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 col-lg-7">
					<!--h2>Formulaire de signalement</h2-->
					<img src="vendors/images/register-page-img.png" alt="">
				</div>
				<div class="col-md-6 col-lg-5">
					<div class="register-box bg-white box-shadow border-radius-10">
						<div class="wizard-content">
							<form class="tab-wizard2 wizard-circle wizard">
								<h5>Infos du signalement</h5>
								<section>
									<div class="form-wrap max-width-600 mx-auto">
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">Type_problme:</label>
											<div class="col-sm-8">
												<input type="text" class="form-control">
											</div>
										</div>
										
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">Description :</label>
											<div class="col-sm-8">
											<textarea type="text" class="form-control"></textarea>
										</div>
										
									 
									</div>
									 
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">Date signal :</label>
											<div class="col-sm-8">
											<input type="text" class="form-control date-picker" placeholder="Select Date">
										</div>
										 
									</div>
									<div class="form-group row">
											<label class="col-sm-4 col-form-label">Etat:</label>
											<div class="col-sm-3">
												<input type="text" class="form-control">
											</div>
										</div>
								</section>
								<!-- Step 2 -->
								<h5>Visualisation du dechet</h5>
								<section>
									<div class="form-wrap max-width-600 mx-auto">
										 
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">Photo</label>
											<div class="col-sm-8">
												<input type="file" class="form-control-file" accept="image/*">
											</div>
										</div>
										 
										<!--div class="form-group row">
														<label class="col-sm-4 col-form-label">Localisation</label>
														<div class="col-sm-8">
															<input type="text" class="form-control" id="location" readonly>
															<button type="button" class="btn btn-primary mt-2" onclick="getLocation()">Obtenir la position</button>
														</div>
													</div-->
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">Latitude</label>
											<div class="col-sm-8">
												<input type="text" class="form-control">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">Longitude</label>
											<div class="col-sm-8">
												<input type="text" class="form-control">
											</div>
										</div>
									</div>
								</section>
								<!-- Step 3 -->
								<h5>Info du resident</h5>
								<section>
									<div class="form-wrap max-width-600 mx-auto">
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">Residents</label>
											<div class="col-sm-8">
												<select class="form-control selectpicker" title="Selectionner un nom">
													<option value="1">Zakaria MAIGA</option>
													<option value="2">Malik Dembele</option>
													<option value="3">Karnon KONE</option>
												</select>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">Autorites</label>
											<div class="col-sm-8">
												<select class="form-control selectpicker" title="Selectionner Mairie">
													<option value="1">Mairie du distruct Bko </option>
													<option value="2">Mairie Commune V</option>
													<option value="3">Mairie Kalaban</option>
												</select>
											</div>
										</div>
									</div>
								</section>
								<!-- Step 4 -->
								<!--h5>Information Generales</h5-->
								<!--section>
									<div class="form-wrap max-width-600 mx-auto">
										<ul class="register-info">
											<li>
												<div class="row">
													<div class="col-sm-4 weight-600">Email Address</div>
													<div class="col-sm-8">example@abc.com</div>
												</div>
											</li>
											<li>
												<div class="row">
													<div class="col-sm-4 weight-600">Username</div>
													<div class="col-sm-8">Example</div>
												</div>
											</li>
											<li>
												<div class="row">
													<div class="col-sm-4 weight-600">Password</div>
													<div class="col-sm-8">.....000</div>
												</div>
											</li>
											<li>
												<div class="row">
													<div class="col-sm-4 weight-600">Full Name</div>
													<div class="col-sm-8">john smith</div>
												</div>
											</li>
											<li>
												<div class="row">
													<div class="col-sm-4 weight-600">Location</div>
													<div class="col-sm-8">123 Example</div>
												</div>
											</li>
										</ul>
										 
									</div>
								</section-->
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- success Popup html Start -->
	<button type="button" id="success-modal-btn" hidden data-toggle="modal" data-target="#success-modal" data-backdrop="static">Launch modal</button>
	<div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered max-width-400" role="document">
			<div class="modal-content">
				<div class="modal-body text-center font-18">
					<h3 class="mb-20">Formulaire  bien soumis!</h3>
					<div class="mb-30 text-center"><img src="vendors/images/success.png"></div>
					Votre formulairea ete bien envoye avec succes!
				</div>
				<div class="modal-footer justify-content-center">
					<a href="/accueil" class="btn btn-primary">Fais</a>
				</div>
			</div>
		</div>
	</div>

   
	  @endsection
	  
	  