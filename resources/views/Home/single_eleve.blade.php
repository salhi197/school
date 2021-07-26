@extends('layouts.app')

@section('content')
	
	<div class="page-header">
		
		<h4 class="page-title">Détails sur le payement de l'élève : {!! $eleve->nom !!} {!! $eleve->prenom !!}</h4>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="clearfix">
						<div class="float-left">
							<h3 class="card-title mb-0">Groupe : {!! $groupe->niveau !!} | {!! $groupe->matiere !!} | {!! $groupe->jour !!} | {!! substr($groupe->heure_debut,0,5) !!}-{!! substr($groupe->heure_fin,0,5) !!}</h3>
						</div>
					</div>

					<hr>

					<div class="row">
						<div class="col-lg-6 ">
							<p class="h3">Informations sur l'élève : </p>
							<address>
								Nom : {!! $eleve->nom !!}<br>
								Prénom : {!! $eleve->prenom !!}<br>
								Numéro tel : {!! $eleve->num_tel !!}<br>
							</address>
						</div>
 						{{--<div class="col-lg-6 text-right">
							<p class="h3">Invoice To:</p>
							<address>
								Street Address<br>
								State, City<br>
								Region, Postal Code<br>
								ypurdomain@example.com
							</address>
						</div> --}}
					</div>
					
					<div class="table-responsive push">
						
						<table class="table table-bordered table-hover mb-0">
							
							<tbody>

								<tr class=" ">
									<th class="text-center">Mois</th>
									<th class="text-center">Cochages</th>
									{{-- 
									<th class="text-center">Présences</th>
									<th class="text-center">Absences</th>  
									--}}
									<th class="text-center">Payé</th>
									<th class="text-center">Retard</th>
								</tr>

								@for ($i = 0; $i <$le_mois-1; $i++)
									
									<tr>
										<td class="text-center col-md-1">{!! $i+1 !!}</td>
										
										<td class="text-left col-md-3">

                                        	@include('includes.single_eleve.cochages',['groupe'=>$groupe,'eleve'=>$eleve,'payement_eleve'=>$payement_eleve,'seances_eleves'=>$seances_eleves,"i"=>$i])


                                        	{{--  --}}
										</td>
										{{-- 
 										<td class="text-center col-md-1">

											@include('includes.single_eleve.presences',['groupe'=>$groupe,'eleve'=>$eleve,'payement_eleve'=>$payement_eleve,'seances_eleves'=>$seances_eleves,"i"=>$i,'les_presences'=>$les_presences,'les_absences'=>$les_absences])
										</td>
										<td class="text-center col-md-1">

											@include('includes.single_eleve.absences',['groupe'=>$groupe,'eleve'=>$eleve,'payement_eleve'=>$payement_eleve,'seances_eleves'=>$seances_eleves,"i"=>$i,'les_presences'=>$les_presences,'les_absences'=>$les_absences])
										</td>--}}										

 										<td class="text-center col-md-4">
											
											@include('includes.single_eleve.payement',['groupe'=>$groupe,'eleve'=>$eleve,'payement_eleve'=>$payement_eleve,'seances_eleves'=>$seances_eleves,"i"=>$i])

											{{--  --}}
										</td>
										
										<td class="text-left col-md-4">			

											@include('includes.single_eleve.retards',['groupe'=>$groupe,'eleve'=>$eleve,'payement_eleve'=>$payement_eleve,'seances_eleves'=>$seances_eleves,"i"=>$i,'les_presences'=>$les_presences,'les_absences'=>$les_absences])

										</td>
									</tr>

									{{-- expr --}}
								@endfor

							</tbody>
						</table>
					</div>
				</div>

				{{--  --}}
			</div>
		</div><!-- COL-END -->
	</div>
	<!-- ROW-1 CLOSED -->

	<script src="{{ asset('js/gerer_retard.js') }}"></script>

@endsection