@for ($p = 0; $p < 12 ; $p++)

	<span id="etudiant{{ $i }}-le_mois{{ $p+1 }}" style="margin-right:2%; border-right: black solid 1px;">Mois : {{ $p+1 }} |  

		@for ($m = $p*4; $m < $p*4+4; $m++)

			<label class="form-check-label" for="mois1-{{$eleves_groupe[$i]->id}}-{{$m+1}}">{!! ($m+1)%4 ? ($m+1)%4 : 4 !!}</label>
																
			<div class="form-check form-check-inline">

				@if ($numero_de_la_seance_dans_le_mois == ($m+1))

				  	<input class="form-check-input is-valid state-valid" type="checkbox" name="mois1" id="mois1-{{$eleves_groupe[$i]->id}}-{{$m+1}}" style="position:relative;">

					
				 @else 	


				 	<?php $dkhel=0; ?>

					@foreach ($seances_eleves as $seances_eleve)
						
						@if ($seances_eleve->id_eleve == $eleves_groupe[$i]->id && $seances_eleve->numero_de_la_seance_dans_le_mois == ($m+1) && $seances_eleve->presence == 1)

							<?php $dkhel++; ?>

						  	<input class="form-check-input" type="checkbox" checked disabled name="mois1" id="mois1-{{$eleves_groupe[$i]->id}}-{{$m+1}}">
							
						  	
						  	


							{{-- expr --}}
						@endif

						@if ($seances_eleve->id_eleve == $eleves_groupe[$i]->id && $seances_eleve->numero_de_la_seance_dans_le_mois == ($m+1) && $seances_eleve->presence == 0)

							<?php $dkhel++; ?>

						  	{{-- <input class="form-check-input" type="checkbox" checked disabled name="mois1" id="mois1-{{$eleves_groupe[$i]->id}}-{{$m+1}}"> --}}

						  	<span class="badge bg-danger"></span>

							{{-- expr --}}
						@endif


						{{-- expr --}}
					@endforeach

					@if ($dkhel == 0)
		
					  	<input class="form-check-input" type="checkbox" disabled name="mois1" id="mois1-{{$eleves_groupe[$i]->id}}-{{$m+1}}">

					  	
					  	

						{{-- expr --}}
					@endif

				@endif
			</div>
		
		@endfor

	</span>

	{{-- expr --}}
@endfor
