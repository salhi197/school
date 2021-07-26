@foreach ($payement_eleve as $payement)
	
	@if ($payement->num_mois == $i+1)
			
		<p> {!! $payement->payement !!} DA | Date : {!! substr($payement->created_at,0,16) !!} </p>
		
		{{-- expr --}}
	@endif


	{{-- expr --}}
@endforeach