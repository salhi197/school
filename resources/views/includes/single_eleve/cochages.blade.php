<?php 
	
	$numItems = count($seances_eleves);
	$pp = 0;
?>

@foreach ($seances_eleves as $seance_eleve)
	
	@if(++$pp != $numItems)

		
		@if ( ((floor(($seance_eleve->num-1)/4)+1)==$i+1) )

			<div style="margin-right : 10%;" class="form-check form-check-inline">
	  	
			  	<label style="margin-right: 20%;" class="form-check-label" for="mois{{$i}}_seance{{$seance_eleve->num}}">	  		
			  		{!! $seance_eleve->num%4 ? $seance_eleve->num%4 : 4 !!}
			  	</label>

			
				@if ($seance_eleve->presence == 1)
					
					<input class="form-check-input" type="checkbox" id="mois{{$i}}_seance{{$seance_eleve->num}}" disabled checked>

				 @elseif($seance_eleve->presence == 0)

					<span class="badge bg-danger"></span>

				 @elseif($seance_eleve->presence == 2)	

				 	<span class="badge bg-success"></span>

					{{-- expr --}}
				@endif

			</div>												
			{{-- expr --}}
		@endif

	 @else
	 	
	 	

		{{--  --}}
	@endif


	
	{{-- expr --}}
@endforeach



