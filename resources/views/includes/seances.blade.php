<span style="margin-right:2%; border-right: black solid 1px;"  >

	@for ($m = 0; $m <4 ; $m++)

		<label class="form-check-label" for="mois1">{!! $m+1 !!}</label>
															
		<div class="form-check form-check-inline">

			@if ($numero_de_la_seance_dans_le_mois == ($m+1))

			  	<input class="form-check-input" type="checkbox" name="mois1" id="mois1-{{$eleves_groupe[$i]->id}}-{{$m+1}}">
				
			 @else 	

			  	<input class="form-check-input" type="checkbox" disabled name="mois1" id="mois1-{{$eleves_groupe[$i]->id}}-{{$m+1}}">
			@endif
		</div>
	
	@endfor

</span>
