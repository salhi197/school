@extends('layouts.app')
@section('content')

	<!-- ROW-1 OPEN -->
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				
				<div class="card-body">
					<div class="clearfix">
						<div class="float-left">
							<h3 class="card-title mb-0">Groupe #{!! $groupe->id !!} {!! $groupe->jour !!} | {!! substr($groupe->heure_debut,0,5) !!}-{!! substr($groupe->heure_fin,0,5) !!}</h3>
						</div>
						<div class="float-right">
							<h3 class="card-title">Date Création: {!! $groupe->created_at !!}</h3>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-lg-6 ">
							<p class="h3">Informations du Groupe : </p>
							<address>
								Année scolaire : {!! $groupe->annee_scolaire !!}<br>
								Niveau : {!! $groupe->niveau !!} <br>
								Matière : {!! $groupe->matiere !!} <br>
							</address>
						</div>
						<div class="col-lg-6 text-right">
							<p class="h3">Informations Prof : </p>
							<address>
								Prof : {!! $groupe->prof !!}<br>
								Num tel : <br>
								Pourcentage prof : {!! $groupe->pourcentage_prof !!} %<br>
							</address>
						</div>
					</div>
				</div>

			
			<a type="button" style="color: #ffffff; margin: 1% 0%;" class="btn btn-primary col-md-3" data-toggle="modal" data-target="#myModal"> <i class="mdi mdi-plus"></i> Ajouter un élève </a>

			<div id="myModal" class="modal fade" role="dialog">

			    <div class="modal-dialog modal-lg">

			        <div class="modal-content">

			           	<div class="modal-header">

			                <h4 class="modal-title">Nouveau Groupe</h4>
			          	</div>

			            <div class="modal-body">

			                <form class="form-inline" method="POST" action="/home/groupes/{{$id}}/ajouter">

			                	{{ csrf_field() }}  

			                    <div class="form-group col-md-6 col-sm-12">

			                        <label for="nom">nom</label>

			                        <input type="text" id="nom" required name="nom" class="form-control col-md-12" autofocus>

			                        {{--  --}}
			                    </div>

			                    <div class="form-group col-md-6 col-sm-12">

			                        <label for="prenom">Prenom</label>

			                        <input type="text" id="prenom" required name="prenom" class="form-control col-md-12">

			                        {{--  --}}
			                    </div>

			                    <div class="form-group col-md-6 col-sm-12">

			                        <label for="num_tel">Num Tel</label>

			                        <input type="tel" id="num_tel" name="num_tel" class="form-control col-md-12">

			                        {{--  --}}
			                    </div>

			                    <div class="form-group col-md-6 col-sm-12">

			                        <label for="payment">Payment</label>

			                        <input type="number" min="0" id="payment" name="payment" class="form-control col-md-12">

			                        {{--  --}}
			                    </div>


			                    <div style="margin-top:3%;" class="selectgroup selectgroup-pills col-md-12">

									<label class="selectgroup-item col-md-7">
										<input type="radio" name="quelle_seance" value="cette" class="selectgroup-input" checked>
										<span class="selectgroup-button">Cette Séance</span>
									</label>

									<label class="selectgroup-item">
										<input type="radio" name="quelle_seance" value="suivante" class="selectgroup-input">
										<span class="selectgroup-button">Prochaine Séance</span>
									</label>

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
								<th style="cursor: pointer;" class="wd-15p">Payé</th>
								<th style="cursor: pointer;" class="wd-15p">Retard</th>
							</tr>
						</thead>
                        
                        <tbody id="all_the_eleves">

                            @for($i=0 ; $i < count($eleves_groupe) ; $i++)

                                <tr id="eleve{{$eleves_groupe[$i]->id}}">

                                    <form>

                                        {{ csrf_field() }}  

                                        <td>

                                            {!! $i+1 !!}                                                
                                        </td>

                                        <td>

                                            {!! $eleves_groupe[$i]->nom  !!}
                                        </td>

                                        <td> 
                                        	
											{!! $eleves_groupe[$i]->prenom !!}
                                        </td>

                                        <td> 
                                        	
											{!! $eleves_groupe[$i]->num_tel !!}
                                        </td>


                                        <td>
                                        		
                                        	@include('includes.seances',['eleves_groupe'=>$eleves_groupe,
                                        		'numero_de_la_seance_dans_le_mois'=>$numero_de_la_seance_dans_le_mois])

                                        	{{--  --}}																						
                                        </td>

                                        <td>
                                        </td>


                                        <td>
                                        </td>

                                    </form>
                                    {{--  --}}
                                </tr>
                                {{-- expr --}}
                            @endfor
                            {{--  --}}
                        </tbody>
 					</table>
				</div>
				</div>


				<div class="card-footer text-right">
					
					<button type="button" class="btn btn-primary mb-1" onclick="javascript:window.print();"><i class="si si-wallet"></i> Pay Invoice</button>

					<a style="color:#ffffff;" groupe="{{ json_encode($groupe) }}" 
					value="{{ json_encode($eleves_groupe) }}"
					seances_eleves="{{ json_encode($seances_eleves) }}"
					numero_de_la_seance_dans_le_mois="{{ json_encode($numero_de_la_seance_dans_le_mois) }}"
					class="btn btn-primary mb-1" onclick="valider_coches(this);">Valider les coches</a>

					{{--  --}}
				</div>
			</div>
		</div><!-- COL-END -->

		<script src="{{ asset('js/gerer_groupe.js') }}"></script>
	</div>
	<!-- ROW-1 CLOSED -->

	

@endsection