@if ($numero_de_la_seance_dans_le_mois%4 == 0)
	
	<?php $le_mois = $le_mois-1; ?>	

	{{-- expr --}}
@endif

@if ($numero_de_la_seance_dans_le_mois%4==1 && $le_mois != 1)
	
	<input id="input_payement{{ $eleves_groupe[$i]->id }}" value="0" max="{{ $groupe->tarif }}" type="number" min="0" class="form-control col-md-12">
	
 @else


	@foreach ($payments as $payment)

		@if ($payment->id_eleve == $eleves_groupe[$i]->id && $payment->payment_du_mois >= $groupe->tarif)

			<p style="color:green;">Complet {!! $payment->payment_du_mois !!} DA </p>

	    	<input style="display:none;" id="input_payement{{ $eleves_groupe[$i]->id }}" value="0" type="number" min="0" max="{{ $groupe->tarif-$payment->payment_du_mois }}" class="form-control col-md-12">


			{{--  --}}
		@endif

		@if ($payment->id_eleve == $eleves_groupe[$i]->id && $payment->payment_du_mois < $groupe->tarif)

			Payé : {!! $payment->payment_du_mois !!} DA

	    	<input id="input_payement{{ $eleves_groupe[$i]->id }}" value="0" type="number" min="0" max="{{ $groupe->tarif-$payment->payment_du_mois }}" class="form-control col-md-12">
	
			Reste : {!! $groupe->tarif-$payment->payment_du_mois !!} DA	    	

			{{--  --}}
		@endif


		{{--  --}}
	@endforeach
	
	{{--  --}}
@endif
