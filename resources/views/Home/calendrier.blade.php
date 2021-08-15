@extends('layouts.app')

@section('content')

	<div class="page-header">
		
		<h4 class="page-title">Calendrier des salles / jours
		</h4>
	</div>


	<!-- vendredi OPEN -->
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">vendredi</h3>
				</div>
				<div class="table-responsive">
					<table class="table card-table table-vcenter text-nowrap table-secondary">
						<thead  class="bg-secondary text-white">
							<tr>
								<th>Salles/Horaires</th>
								
								@foreach ($salles_profs_vendredis as $horaire)
									
									<th>{!! substr($horaire->heure_debut,0,5) !!} - {!! substr($horaire->heure_fin,0,5) !!}</th>
									{{-- expr --}}
								@endforeach
							</tr>
						</thead>
						
						<tbody>

							@for ($i = 0; $i < count($salles) ; $i++)
								
								<tr>
									<th scope="row">{!! $salles[$i]->num !!}</th>

									@foreach ($salles_profs_vendredi as $salle_prof)

										@if ($salle_prof->classe == $salles[$i]->num)
													
											<td> 
												<p style="font-weight: bold;" >{!! $salle_prof->prof !!}</p> {!! $salle_prof->matiere !!} 
											</td>

											{{-- expr --}}
										@endif										

										{{-- expr --}}
									@endforeach
								</tr>

								{{-- expr --}}
							@endfor

						</tbody>
					</table>
				</div>
				<!-- table-responsive -->
			</div>
		</div>
	</div>
	<!-- vendredi CLOSED -->



	<!-- samedi OPEN -->
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">samedi</h3>
				</div>
				<div class="table-responsive">
					<table class="table card-table table-vcenter text-nowrap table-secondary">
						<thead  class="bg-secondary text-white">
							<tr>
								<th>Salles/Horaires</th>
								
								@foreach ($salles_profs_samedis as $horaire)
									
									<th>{!! substr($horaire->heure_debut,0,5) !!} - {!! substr($horaire->heure_fin,0,5) !!}</th>
									{{-- expr --}}
								@endforeach
							</tr>
						</thead>
						<tbody>

							@for ($i = 0; $i < count($salles) ; $i++)
								
								<tr>
									<th scope="row">{!! $salles[$i]->num !!}</th>

									@foreach ($salles_profs_samedi as $salle_prof)

										@if ($salle_prof->classe == $salles[$i]->num)

											@foreach ($salles_profs_samedis as $h_samedi)
												
												@if ($h_samedi->heure_debut == $salle_prof->heure_debut)
													
													<td> <p style="font-weight: bold;" >{!! $salle_prof->prof !!}</p> {!! $salle_prof->matiere !!} </td>
												@else

													

													{{-- expr --}}
												@endif

												{{-- expr --}}
											@endforeach

										@endif										

										{{-- expr --}}
									@endforeach
								</tr>

								{{-- expr --}}
							@endfor

						</tbody>
					</table>
				</div>
				<!-- table-responsive -->
			</div>
		</div>
	</div>
	<!-- samedi CLOSED -->



	<!-- ROW-4 OPEN -->
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Dimanche</h3>
				</div>
				<div class="table-responsive">
					<table class="table card-table table-vcenter text-nowrap table-secondary">
						<thead  class="bg-secondary text-white">
							<tr>
								<th>Salles/Horaires</th>
								
								@foreach ($salles_profs_dimanches as $horaire)
									
									<th>{!! substr($horaire->heure_debut,0,5) !!} - {!! substr($horaire->heure_fin,0,5) !!}</th>
									{{-- expr --}}
								@endforeach
							</tr>
						</thead>
						<tbody>

							@for ($i = 0; $i < count($salles) ; $i++)
								
								<tr>
									<th scope="row">{!! $salles[$i]->num !!}</th>

									@foreach ($salles_profs_dimanche as $salle_prof)

										@if ($salle_prof->classe == $salles[$i]->num)
											

											@foreach ($salles_profs_dimanches as $h_dimanche)
												
												@if ($h_dimanche->heure_debut == $salle_prof->heure_debut)
													
													<td> <p style="font-weight: bold;" >{!! $salle_prof->prof !!}</p> {!! $salle_prof->matiere !!} </td>
												@else

													

													{{-- expr --}}
												@endif

												{{-- expr --}}
											@endforeach

											{{--  --}}
										@endif										

										{{-- expr --}}
									@endforeach
								</tr>

								{{-- expr --}}
							@endfor

						</tbody>
					</table>
				</div>
				<!-- table-responsive -->
			</div>
		</div>
	</div>
	<!-- ROW-4 CLOSED -->




	<!-- Lundi OPEN -->
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">lundi</h3>
				</div>
				<div class="table-responsive">
					<table class="table card-table table-vcenter text-nowrap table-secondary">
						<thead  class="bg-secondary text-white">
							<tr>
								<th>Salles/Horaires</th>
								
								@foreach ($salles_profs_lundis as $horaire)
									
									<th>{!! substr($horaire->heure_debut,0,5) !!} - {!! substr($horaire->heure_fin,0,5) !!}</th>
									{{-- expr --}}
								@endforeach
							</tr>
						</thead>
						<tbody>

							@for ($i = 0; $i < count($salles) ; $i++)
								
								<tr>
									<th scope="row">{!! $salles[$i]->num !!}</th>

									@foreach ($salles_profs_lundi as $salle_prof)

										@if ($salle_prof->classe == $salles[$i]->num)


											@foreach ($salles_profs_lundis as $h_lundi)
												
												@if ($h_lundi->heure_debut == $salle_prof->heure_debut)
													
													<td> <p style="font-weight: bold;" >{!! $salle_prof->prof !!}</p> {!! $salle_prof->matiere !!} </td>
												@else

													

													{{-- expr --}}
												@endif

												{{-- expr --}}
											@endforeach


											{{--  --}}
										@endif										

										{{-- expr --}}
									@endforeach
								</tr>

								{{-- expr --}}
							@endfor

						</tbody>
					</table>
				</div>
				<!-- table-responsive -->
			</div>
		</div>
	</div>
	<!-- Lundi CLOSED -->



	<!-- mardi OPEN -->
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">mardi</h3>
				</div>
				<div class="table-responsive">
					<table class="table card-table table-vcenter text-nowrap table-secondary">
						<thead  class="bg-secondary text-white">
							<tr>
								<th>Salles/Horaires</th>
								
								@foreach ($salles_profs_mardis as $horaire)
									
									<th>{!! substr($horaire->heure_debut,0,5) !!} - {!! substr($horaire->heure_fin,0,5) !!}</th>
									{{-- expr --}}
								@endforeach
							</tr>
						</thead>
						<tbody>

							@for ($i = 0; $i < count($salles) ; $i++)
								
								<tr>
									<th scope="row">{!! $salles[$i]->num !!}</th>

									@foreach ($salles_profs_mardi as $salle_prof)

										@if ($salle_prof->classe == $salles[$i]->num)

											@foreach ($salles_profs_mardis as $h_mardi)
												
												@if ($h_mardi->heure_debut == $salle_prof->heure_debut)
													
													<td> <p style="font-weight: bold;" >{!! $salle_prof->prof !!}</p> {!! $salle_prof->matiere !!} </td>
												@else

													

													{{-- expr --}}
												@endif

												{{-- expr --}}
											@endforeach



											{{--  --}}
										@endif										

										{{-- expr --}}
									@endforeach
								</tr>

								{{-- expr --}}
							@endfor

						</tbody>
					</table>
				</div>
				<!-- table-responsive -->
			</div>
		</div>
	</div>
	<!-- mardi CLOSED -->



	<!-- mercredi OPEN -->
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">mercredi</h3>
				</div>
				<div class="table-responsive">
					<table class="table card-table table-vcenter text-nowrap table-secondary">
						<thead  class="bg-secondary text-white">
							<tr>
								<th>Salles/Horaires</th>
								
								@foreach ($salles_profs_mercredis as $horaire)
									
									<th>{!! substr($horaire->heure_debut,0,5) !!} - {!! substr($horaire->heure_fin,0,5) !!}</th>
									{{-- expr --}}
								@endforeach
							</tr>
						</thead>
						<tbody>

							@for ($i = 0; $i < count($salles) ; $i++)
								
								<tr>
									<th scope="row">{!! $salles[$i]->num !!}</th>

									@foreach ($salles_profs_mercredi as $salle_prof)

										@if ($salle_prof->classe == $salles[$i]->num)


											@foreach ($salles_profs_mercredis as $h_mercredi)
												
												@if ($h_mercredi->heure_debut == $salle_prof->heure_debut)
													
													<td> <p style="font-weight: bold;" >{!! $salle_prof->prof !!}</p> {!! $salle_prof->matiere !!} </td>
												@else

													

													{{-- expr --}}
												@endif

												{{-- expr --}}
											@endforeach


											{{--  --}}
										@endif										

										{{-- expr --}}
									@endforeach
								</tr>

								{{-- expr --}}
							@endfor

						</tbody>
					</table>
				</div>
				<!-- table-responsive -->
			</div>
		</div>
	</div>
	<!-- mercredi CLOSED -->



	<!-- jeudi OPEN -->
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">jeudi</h3>
				</div>
				<div class="table-responsive">
					<table class="table card-table table-vcenter text-nowrap table-secondary">
						<thead  class="bg-secondary text-white">
							<tr>
								<th>Salles/Horaires</th>
								
								@foreach ($salles_profs_jeudis as $horaire)
									
									<th>{!! substr($horaire->heure_debut,0,5) !!} - {!! substr($horaire->heure_fin,0,5) !!}</th>
									{{-- expr --}}
								@endforeach
							</tr>
						</thead>
						<tbody>

							@for ($i = 0; $i < count($salles) ; $i++)
								
								<tr>
									<th scope="row">{!! $salles[$i]->num !!}</th>

									@foreach ($salles_profs_jeudi as $salle_prof)

										@if ($salle_prof->classe == $salles[$i]->num)
											

											@foreach ($salles_profs_jeudis as $h_jeudi)
												
												@if ($h_jeudi->heure_debut == $salle_prof->heure_debut)
													
													<td> <p style="font-weight: bold;" >{!! $salle_prof->prof !!}</p> {!! $salle_prof->matiere !!} </td>
												@else

													

													{{-- expr --}}
												@endif

												{{-- expr --}}
											@endforeach



											{{--  --}}
										@endif										

										{{-- expr --}}
									@endforeach
								</tr>

								{{-- expr --}}
							@endfor

						</tbody>
					</table>
				</div>
				<!-- table-responsive -->
			</div>
		</div>
	</div>
	<!-- jeudi CLOSED -->


	{{--  --}}
@endsection