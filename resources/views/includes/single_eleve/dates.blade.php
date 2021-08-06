<?php 
	
	$numItems = count($seances_eleves);
	$pp = 0;
?>

@foreach ($seances_eleves as $seance_eleve)
	
	@if(++$pp != $numItems)

		
		@if ( ((floor(($seance_eleve->num-1)/4)+1)==$i+1) )

			<div style="margin-right : 10%;" class="form-check col-md-12 form-check-inline">
	  	
			  	<label style="font-size: 13px; margin-right: 20%;" class="form-check-label col-md-12 " for="mois{{$i}}_seance{{$seance_eleve->num}}">	  		
			  		{!! $seance_eleve->num%4 ? $seance_eleve->num%4 : 4 !!} | {!! substr($seance_eleve->created_at,0,16) !!}
			  	</label>

			
 				{{--@if ($seance_eleve->presence == 1)
					
					<input class="form-check-input col-md-6" type="checkbox" id="mois{{$i}}_seance{{$seance_eleve->num}}" disabled checked>

				 @elseif($seance_eleve->presence == 0)

					<span class="badge bg-danger"></span>

					
				@endif--}}
 
			</div>												
			{{-- expr --}}
		@endif

	 @else
	 	
	 	

		{{--  --}}
	@endif


	
	{{-- expr --}}
@endforeach



