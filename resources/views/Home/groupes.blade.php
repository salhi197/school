@extends('layouts.app')
@section('content')

<!-- PAGE-HEADER -->
<div class="page-header">
	<h4 class="page-title">Groupes de l'année scolaire {!! $annee_scolaire !!}</h4>
</div>
<!-- PAGE-HEADER END -->

<div id="modif_effectue" class="alert alert-icon alert-success" role="alert">
	<i class="fa fa-check-circle-o mr-2" aria-hidden="true"></i> 
	Groupe Modifiée avec succée
</div>

<div id="suppression_effectue" class="alert alert-icon alert-warning" role="alert">
	<i class="fa fa-exclamation mr-2" aria-hidden="true"></i> 
	Vous venez de supprimer un groupe
</div>




<a type="button" style="color: #ffffff; margin-top: 5%; margin-bottom:1%;" class="btn btn-primary" data-toggle="modal" data-target="#myModal"> <i class="mdi mdi-plus"></i> Ajouter un groupe </a>
<button type="button" style="color: #ffffff; margin-top: 5%; margin-bottom:1%;" class="btn btn-primary"  id="btnPrint"> Imprimer </button>

<div id="myModal" class="modal fade" role="dialog">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

           	<div class="modal-header">

                <a type="button" class="close" data-dismiss="modal">&times;</a>

                <h4 class="modal-title">Nouvel Groupe</h4>
          	</div>

            <div class="modal-body">

                <form class="form-inline" method="POST" action="/home/groupes/ajouter/ajax">

                    {{ csrf_field() }}  

                    <div class="form-group col-md-4 col-sm-12">

                        <label for="jourdugroupe">jour </label>

                        <select id="jourdugroupe" onchange="fit_salles();" required="true" name="jour" class="form-control col-md-12">
                            <option value="Dimanche"> Dimanche </option>
                            <option value="Lundi"> Lundi </option>
                            <option value="Mardi"> Mardi </option>
                            <option value="Mercredi"> Mercredi </option>
                            <option value="Jeudi"> Jeudi </option>
                            <option value="Vendredi"> Vendredi </option>
                            <option value="Samedi"> Samedi </option>
                        </select>

                        {{--  --}}
                    </div>


                    <div class="form-group col-md-4 col-sm-12">

                        <label for="heure_debutdugroupe">Heure Début</label>

                        <input type="time" min="08:00" onchange="fit_salles();" id="heure_debutdugroupe" required name="heure_debut" class="form-control col-md-12">

                        {{--  --}}
                    </div>


                    <div class="form-group col-md-4 col-sm-12">

                        <label for="heure_findugroupe">Heure Fin</label>

                        <input type="time" min="08:00" onchange="fit_salles();" id="heure_findugroupe" required name="heure_fin" class="form-control col-md-12">

                        {{--  --}}
                    </div>


                    <div class="form-group col-md-4 col-sm-12">

                        <label for="salledugroupe">salle </label>

                        <select id="salledugroupe" onchange="fit_salles();" required="true" name="salle" class="form-control col-md-12">

                            @foreach ($salles as $salle)
                                
                                <option value="{{ $salle->num }}"> {!! $salle->num !!} </option>

                                {{-- expr --}}
                            @endforeach

                        </select>

                        {{--  --}}
                    </div>
                    
                    <div class="form-group col-md-4 col-sm-12">

                        <label for="niveaudugroupe">Niveau </label>

                        <select name="niveau" id="niveaudugroupe" class="form-control select2-show-search col-md-12">
                            
                            @foreach ($niveaux as $niveau)
                            
                                <option value="{{ $niveau->niveau }}-{{ $niveau->cycle}}-{{$niveau->filiere }}">{!! $niveau->niveau !!}-{!! $niveau->cycle !!}-{!! $niveau->filiere !!}</option>
                            
                            @endforeach                            
                            
                            
                            {{--  --}}
                        </select>

                        {{--  --}}
                    </div>


                    <div class="form-group col-md-4 col-sm-12">

                        <label for="matieredugroupe">Matière </label>

                        <select name="matiere" onchange="fit_prof(this)" id="matieredugroupe" class="form-control col-md-12 ">
                            
                            @foreach ($matieres as $matiere)
                            
                                <option value="{{ $matiere->nom }}">{!! $matiere->nom !!}</option>
                            
                            @endforeach                            
                            
                            
                            {{--  --}}
                        </select>

                        {{--  --}}
                    </div>


                    <div class="form-group col-md-4 col-sm-12">

                        <label for="profdugroupe"> Prof </label>

                        <select name="prof" id="profdugroupe" class="form-control col-md-12 select2-show-search">
                            
                            @foreach ($profs as $prof)
                            
                                <option id="{{ $prof->nom }}-{{ $prof->prenom }}" value="{{ $prof->nom }}-{{ $prof->prenom }}">{!! $prof->nom !!}-{!! $prof->prenom !!} &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</option>
                            
                            @endforeach                            
                            
                            
                            {{--  --}}
                        </select>

                        {{--  --}}
                    </div>

                    <div class="form-group col-md-4 col-sm-12">

                        <label for="pourcentage_profdugroupe"> % Prof </label>

                        <input type="number" onchange="fit_prctg(this);" value="50" min="30" max="100" id="pourcentage_profdugroupe" required name="pourcentage_prof" class="form-control col-md-12">

                        {{--  --}}
                    </div>


                    <div style="display:none;" class="form-group col-md-4 col-sm-12">

                        <label for="pourcentage_ecoledugroupe"> % Ecole </label>

                        <input type="number" disabled value="50" id="pourcentage_ecoledugroupe" required name="pourcentage_ecole" class="form-control col-md-12">

                        {{--  --}}
                    </div>

                    <div class="form-group col-md-4 col-sm-12">

                        <label for="tarif"> Tarif </label>

                        <input type="number" min="0" value="1800" id="tarif" required name="tarif" class="form-control col-md-12">

                        {{--  --}}
                    </div>



                    <input type="submit" style="color: #2070F5; margin-top: 5%;" class="btn btn-outline-primary col-md-12" value="Ajouter">

                  	{{-- <a style="color: #2070F5; margin-top: 5%;" id="ajout{{ $last_id }}" data-dismiss="modal" onclick="ajoutergroupe(event,this)" class="btn btn-outline-primary col-md-12">Ajouter</a> --}}
                </form>

                {{--  --}}
          </div>

          <div class="modal-footer">

                <a type="button" style="color: #ffffff;" class="btn btn-warning" data-dismiss="modal">Fermer</a>

          </div>

        </div>

        {{--  --}}
  </div>

</div>                    













































<!-- ROW-1 OPEN -->
<div class="row">
	<div class="col-md-12 col-lg-12">
		<div class="card">
			
			<div class="card-header">
				
				<div class="card-title " >Groupes 
					
					<span id="alert" class="alert alert-sccess"> </span> 

					{{--  --}}
				</div>
			</div>
			
			<div class="card-body">
				
				<div class="table-responsive">
					
					<table data-page-length='50' id="datable-1" class="table table-striped table-bordered text-nowrap w-100">
						<thead>
							<tr>
								<th style="cursor: pointer;" class="wd-15p">N°</th>
								<th style="cursor: pointer;" class="wd-15p">Jour</th>
								<th style="cursor: pointer;" class="wd-20p">Début</th>
								<th style="cursor: pointer;" class="wd-15p">Fin</th>
                                <th style="cursor: pointer;" class="wd-15p">Salle</th>
                                <th style="cursor: pointer;" class="wd-15p">Matière</th>
                                <th style="cursor: pointer;" class="wd-15p">Niveau</th>
                                <th style="cursor: pointer;" class="wd-15p">Prof</th>
                                <th style="cursor: pointer;" class="wd-15p">%_Prof</th>
                                <th style="cursor: pointer;" class="wd-15p">%_école</th>
                                <th style="cursor: pointer;" class="wd-15p">NB</th>
								<th style="cursor: pointer;" class="wd-15p">Création</th>
                                {{-- <th style="cursor: pointer;" class="wd-15p">Actions</th> --}}
							</tr>
						</thead>
                        
                        <tbody id="all_the_groupes">

                            @for($i=0 ; $i < count($groupes) ; $i++)

                                <tr onclick="goto_the_link(this);" style="cursor:pointer;" id="groupe{{$groupes[$i]->id}}">

                                    <form>

                                        {{ csrf_field() }}  

                                        <td>

                                            {!! $i+1 !!}                                                
                                        </td>

                                        <td>
                                            <span>{!! $groupes[$i]->jour  !!}</span>

                                        </td>

                                        <td> 
                                            <span>{!! substr($groupes[$i]->heure_debut,0,5)  !!}</span>                              
                                        </td>


                                        <td> 
                                            <span>{!! substr($groupes[$i]->heure_fin,0,5) !!}</span>                              
                                        </td>

                                        <td> 
                                            <span>{!! $groupes[$i]->classe  !!}</span>                              
                                        </td>

                                        <td> 
                                            
                                            <span>{!! $groupes[$i]->matiere !!}</span>
                                        </td>

                                        <td> 
                                            <span>{!! $groupes[$i]->niveau  !!}</span>                              
                                        </td>

                                        <td> 
                                            <span>{!! $groupes[$i]->prof  !!}</span>                              
                                        </td>


                                        <td> 
                                            <span>{!! $groupes[$i]->pourcentage_prof  !!}%</span>                              
                                        </td>

                                        <td> 
                                            <span>{!! $groupes[$i]->pourcentage_ecole  !!}%</span>                              
                                        </td>

                                        <td> 

                                            @foreach ($eleves_groupe as $groupee)
                                                
                                                @if($groupee->id_groupe==$groupes[$i]->id)
                                                   
                                                    <span>{!! $groupee->nb_eleves !!}</span>                              

                                                    {{-- expr --}}
                                                @endif

                                                {{-- expr --}}
                                            @endforeach

                                        </td>

                                        <td> 
                                            
                                            <span>{!! substr(date('d/m/Y H:i:s',strtotime($groupes[$i]->created_at)),0,10) !!}</span>
                                        </td>

{{--                                         <td> 

                                            <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModalsup-{{$groupes[$i]->id}}" style="color: #fff;" onclick="event.preventDefault();"> Archiver</a>

                                            <div id="myModalsup-{{$groupes[$i]->id}}" class="modal fade" role="dialog">

                                              <div class="modal-dialog modal-lg">

                                                    <!-- Modal content-->

                                                    <div class="modal-content">

                                                       <div class="modal-header">

                                                            <h4 class="modal-title">Voulez-vous vraiment Archiver ce Groupe ?</h4>
                                                      </div>

                                                      <div class="modal-body">

                                                            <a class="col-md-5 col-sm-12 btn btn-danger" onclick="supprimergroupe(event,this)" data-dismiss="modal" style="color: #ffffff;" id="mod{{$groupes[$i]->id}}">OUI,je supprime</a>

                                                            <a data-dismiss="modal" class="col-md-6 col-sm-12 btn btn-primary" style="color: #ffffff;" >NON,je ne veux pas supprimer</a>

                                                      </div>

                                                      <div class="modal-footer">

                                                            <a class="btn btn-warning" data-dismiss="modal" style="color: #ffffff;">Fermer</a>
                                                      </div>
                                                    </div>

                                              </div>
                                            </div>                    
                                        </td>
 --}}                                    </form>
                                    {{--  --}}
                                </tr>
                                
                                {{-- expr --}}
                            @endfor
                            {{--  --}}
                        </tbody>
 					</table>
				</div>
			</div>
			<!-- TABLE WRAPPER -->
		</div>
		<script src="{{ asset('js/modifierlesgroupes.js') }}"></script>
		<!-- SECTION WRAPPER -->
	</div>
</div>

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