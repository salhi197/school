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


			<div class="card-body">
				
				<div class="table-responsive">
					
					<table data-page-length='50' id="datable-1" class="table table-striped table-bordered text-nowrap w-100">
						<thead>
							<tr>
								<th style="cursor: pointer;" class="wd-15p">N°</th>
								<th style="cursor: pointer;" class="wd-15p">Nom</th>
								<th style="cursor: pointer;" class="wd-15p">Prénom</th>
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
                                        												
                                        	<span style="margin-right:2%; border-right: black solid 1px;"  >

	                                        	@for ($m = 0; $m <4 ; $m++)

													<label class="form-check-label" for="inlineCheckbox1">{!! $m+1 !!}</label>

													<div class="form-check form-check-inline">
													  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
													</div>
                                        		
	                                        	@endfor

											</span>
											
                                        	<span style="margin-right:2%; border-right: black solid 1px;"  >

	                                        	@for ($m = 0; $m <4 ; $m++)

													<label class="form-check-label" for="inlineCheckbox1">{!! $m+1 !!}</label>

													<div class="form-check form-check-inline">
													  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
													</div>
	                                        	@endfor
											
											</span>
                                        	
                                        	<span style="margin-right:2%; border-right: black solid 1px;"  >

	                                        	@for ($m = 0; $m <4 ; $m++)

													<label class="form-check-label" for="inlineCheckbox1">{!! $m+1 !!}</label>

													<div class="form-check form-check-inline">
													  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
													</div>                                  		
	                                        	@endfor

											</span>


                                        	<span >

	                                        	@for ($m = 0; $m <4 ; $m++)

													<label class="form-check-label" for="inlineCheckbox1">{!! $m+1 !!}</label>

													<div class="form-check form-check-inline">
													  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
													</div>                                  		
	                                        	@endfor

											</span>
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
					<button type="button" class="btn btn-success mb-1" onclick="javascript:window.print();"><i class="si si-paper-plane"></i> Send Invoice</button>
					<button type="button" class="btn btn-info mb-1" onclick="javascript:window.print();"><i class="si si-printer"></i> Print Invoice</button>
				</div>
			</div>
		</div><!-- COL-END -->
	</div>
	<!-- ROW-1 CLOSED -->

	

@endsection