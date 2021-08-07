@extends('layouts.app')
@section('content')

	<!-- ROW-1 OPEN -->
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<!-- HIDDEN DATA -->
				<input type="hidden" value="{{$dawra->id ?? ''}}" id="dawra_id" />
				<!-- HIDDEN DATA -->

				
				<div class="card-body">
					<div class="clearfix">
						<div class="float-left">
							<h3 class="card-title mb-0">Dawra </h3>
						</div>
						<div class="float-right">
							<h3 class="card-title">Date Création: {{ $dawra->created_at ?? "" }}</h3>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-lg-6 ">
							<p class="h3">Informations du Dawra : </p>
							<address>
								Année scolaire : {{ $dawra->annee_scolaire ?? "" }}<br>
								Niveau : {{ $dawra->niveau ?? "" }} <br>
								Matière : {{ $dawra->matiere ?? "" }} <br>
								Tarif : {{ $dawra->tarif ?? "" }} DA 
							</address>
						</div>
						<div class="col-lg-6 text-right">
							<p class="h3">Informations Prof : </p>
							<address>
								Prof : {{ $dawra->prof ?? "" }}<br>

								Pourcentage prof : {{ $dawra->pourcentage_prof ?? "" }} %<br>
							</address>
						</div>
					</div>
				</div>
			<div class="row">
			<div class="col-md-3">
					<a type="button" style="color: #ffffff; margin: 1% 0%;" class="btn btn-primary" data-toggle="modal" data-target="#myModal"> <i class="mdi mdi-plus"></i> Ajouter un élève </a>
				</div>
				<div class="col-md-3">
					<button type="button" style="color: #ffffff; margin: 1% 0%;" class="btn btn-primary"  id="btnPrint"> Imprimer </button>
				</div>


			</div>
			

			<div id="myModal" class="modal fade" role="dialog">

			    <div class="modal-dialog modal-lg">

			        <div class="modal-content">

			           	<div class="modal-header">

			                <h4 class="modal-title">Nouveau Etudiant</h4>
			          	</div>

			            <div class="modal-body">

			                <form class="form-inline" method="POST" action="/home/dawra/{{$dawra->id}}/ajouter">

			                	{{ csrf_field() }}  

			                    <div class="form-group col-md-3 col-sm-12">

			                        <label for="nom">nom</label>

			                        <input type="text" id="nom" required name="nom" class="form-control col-md-12" autofocus>

			                        {{--  --}}
			                    </div>

			                    <div class="form-group col-md-3 col-sm-12">

			                        <label for="prenom">Prenom</label>

			                        <input type="text" id="prenom" required name="prenom" class="form-control col-md-12">

			                        {{--  --}}
			                    </div>

			                    <div class="form-group col-md-3 col-sm-12">

			                        <label for="num_tel">Num Tel</label>

			                        <input type="tel" id="num_tel" name="num_tel" class="form-control col-md-12">

			                        {{--  --}}
			                    </div>

			                    <div class="form-group col-md-3 col-sm-12">

			                        <label for="payment">Payment</label>

			                        <input type="number" min="0" max="{{$dawra->tarif ?? ""}}" value="0" id="payment" name="payment" class="form-control col-md-12">
			                        


			                        {{--  --}}
			                    </div>



								<input type="submit" style="color: #2070F5; margin-top: 5%;" class="btn btn-outline-primary col-md-12" value="Ajouter">
			                </form>
			            </div> 

			          	<div class="modal-footer">

			                <a type="button" style="color: #ffffff;" class="btn btn-warning" data-dismiss="modal">Fermer</a>

			          	</div>


			        </div>

			    </div>
		    
			</div>           
























			<div class="card-body">
				
				<div class="table-responsive">
					
					<table data-page-length='50' id="datable-1" class="table table-striped table-bordered text-nowrap w-100">
						<thead>
							<tr>
								<th style="cursor: pointer;" class="wd-15p">N°</th>
								<th style="cursor: pointer;" class="wd-15p">Nom</th>
								<th style="cursor: pointer;" class="wd-15p">Prénom</th>
								<th style="cursor: pointer;" class="wd-15p">Num tel</th>
								<th style="cursor: pointer;" class="wd-15p">Séances</th>
								<th style="cursor: pointer; color: green;" class="wd-15p">Payé</th>
								<th style="cursor: pointer; color: red;" class="wd-15p">Retard</th>
							</tr>
						</thead>
                        
                        <tbody id="all_the_eleves">
							@foreach($eleves as $key=>$eleve)
                                <tr>

									<td class="col-md-1">

										{{ $key }}                                                
									</td>

									<td class="col-md-1" >

										{{ $eleve->nom  }}
									</td>

									<td class="col-md-1" > 
										
										{{ $eleve->prenom }}
									</td>

									<td class="col-md-1" > 
										
										{{ $eleve->num_tel }}
									</td>


									<td class="col-md-4" >
											Séances : 

											@foreach($eleve->getDawraSeances($dawra->id) as $seance)
												<div class="form-check form-check-inline">
													<input  eleve="{{$eleve->id}}"
													<?php if($seance->num_seance !=	 $dawra->current_seance) echo "disabled"; ?>
													seance="{{$seance->num_seance}}" id=""  class="form-check-input checkboxes"  type="checkbox" 
														@if($seance->presence ==1)
															checked																
														@endif>
												</div>												
											@endforeach
									</td>

									<td class="col-md-4" >
										{{ $eleve->getEleveDawraPayment($dawra->id) ?? ' ' }}
									</td>


									<td class="col-md-4" style="cursor:pointer;" onclick="goto_the_link(this)" id="eleve{{$eleve->id}}" groupe="{{ $dawra->id }}">
										{{ $eleve->getEleveDawraReste($dawra->id) ?? ' ' }}
									</td>
                                </tr>
							@endforeach
                        </tbody>
 					</table>
				</div>
				</div>



				<div class="card-footer text-right">
				
					<a id="valider_les_coches" style="color:#ffffff;"
					class="btn btn-primary mb-1" onclick="valider_coches(this);">Valider les coches</a>

					<button id="valider" style="display:none;" class="btn btn-outline-success" groupe="{{ json_encode($dawra) }}" 
					

					onclick="valider_tous(this)" >OUI, Valider</button>

					<button id="ne_pas_valider" onclick="retour(this)" style="display:none;" class="btn btn-outline-danger">NOn, Pas Encore</button>

					{{--  --}}
				</div>

				<div class="card-footer text-left row" style="color:blue;">


				</div>
			</div>
		</div><!-- COL-END -->



	    <a class="btn btn-outline-danger text-center col-md-12" style="color:red;" data-toggle="modal" data-target="#myModalsup-{{$dawra->id ?? ""}}" style="color: #fff;" onclick="event.preventDefault();"> Archiver</a>

	    <div id="myModalsup-{{$dawra->id ?? ""}}" class="modal fade" role="dialog">

	      	<div class="modal-dialog modal-lg">

	            <!-- Modal content-->

	            <div class="modal-content">

	               <div class="modal-header">

	                    <h4 class="modal-title">Voulez-vous vraiment Archiver ce Groupe ?</h4>
	              </div>

	              <div class="modal-body">

	                    <a class="col-md-5 col-sm-12 btn btn-danger" onclick="supprimergroupe(event,this)" data-dismiss="modal" style="color: #ffffff;" id="mod{{$dawra->id ?? ""}}">OUI,Archiver</a>

	                    <a data-dismiss="modal" class="col-md-6 col-sm-12 btn btn-primary" style="color: #ffffff;" >NON,je ne veux pas archiver</a>

	              </div>

	              <div class="modal-footer">

	                    <a class="btn btn-warning" data-dismiss="modal" style="color: #ffffff;">Fermer</a>
	              </div>
	            </div>

	      	</div>
	    </div>                    




		<script src="{{ asset('js/gerer_dawra.js') }}"></script>
	</div>
	<!-- ROW-1 CLOSED -->


	<script type="text/javascript">
		
		var numero_de_la_seance_dans_le_mois = [];

		quel_mois = ( parseInt((numero_de_la_seance_dans_le_mois-1)/4))+1;

		var nb_eleves = []

		console.log(numero_de_la_seance_dans_le_mois);

		for (var i = 0; i <nb_eleves; i++) 
		{
			
			for (var j = 1; j <= 12; j++) 
			{
				
				var le_mois = "etudiant"+i+"-le_mois"+j;

				document.getElementById(le_mois).style.display = "none";

				//
			}

			//
		}

		if (quel_mois >= 3) 
		{

			for (var i = 0; i <nb_eleves; i++) 
			{
				
				for (var j = quel_mois-1; j <= quel_mois; j++) 
				{
					
					var le_mois = "etudiant"+i+"-le_mois"+j;

					document.getElementById(le_mois).style.display = "inline-block";

					//
				}

				//
			}

			//
		}
		else
		{

			for (var i = 0; i <nb_eleves; i++) 
			{
				
				for (var j = 1; j <= 2; j++) 
				{
					
					var le_mois = "etudiant"+i+"-le_mois"+j;

					document.getElementById(le_mois).style.display = "inline-block";

					//
				}

				//
			}

			//
		}

		//
	</script>

	
	{{--  --}}
@endsection

@section('scripts')
<script type="text/javascript">
$(document).ready(function(){
    console.log($("#btnPrint").html());
    $("#btnPrint").on('click',function(){
//            var divContents = $("#datable-1").html();
            $('#datable-1').printThis();
    })
});



</script>
@endsection