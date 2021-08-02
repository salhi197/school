@if ($numero_de_la_seance_dans_le_mois%4 == 0)
	
	<?php $le_mois = $le_mois-1; ?>	

	{{-- expr --}}
@endif

<?php $complet = false;?>
<?php $avance = 0;?>

@if ($numero_de_la_seance_dans_le_mois%4==1 && $le_mois != 1)
	
	@foreach ($payments as $payment)
		
		@if ($payment->id_eleve == $eleves_groupe[$i]->id && $payment->payment_du_mois >=0)		

			<p style="color:green;" class="text-center"> Payé : {!! $payment->payment_du_mois !!} DA </p> 

			<?php $avance = $payment->payment_du_mois;?>

			@if ($payment->payment_du_mois==$groupe->tarif)
				
				<?php $complet = true;?>
				
				{{-- expr --}}
			@endif

			{{--  --}}
		@endif	

		{{-- expr --}}
	@endforeach

	@if (!$complet)
		
		<input id="input_payement{{ $eleves_groupe[$i]->id }}" value="0" max="{{ $groupe->tarif-$avance }}" type="number" min="0" class="form-control col-md-12">
	
		{{-- expr --}}
	@endif

	
 @else


	@foreach ($payments as $payment)

		@if ($payment->id_eleve == $eleves_groupe[$i]->id && $payment->payment_du_mois >= $groupe->tarif)

			<p style="color:green;">Complet {!! $payment->payment_du_mois !!} DA </p>

	    	<input style="display:none;" id="input_payement{{ $eleves_groupe[$i]->id }}" value="0" type="number" min="0" max="{{ $groupe->tarif-$payment->payment_du_mois }}" class="form-control col-md-12">

	    	

			{{--  --}}
		@endif

		@if ($payment->id_eleve == $eleves_groupe[$i]->id && $payment->payment_du_mois < $groupe->tarif)

			<p style="color:green;" class="text-center"> Payé : {!! $payment->payment_du_mois !!} DA </p> 

	    	<input id="input_payement{{ $eleves_groupe[$i]->id }}" value="0" type="number" min="0" max="{{ $groupe->tarif-$payment->payment_du_mois }}" class="form-control col-md-12">

	    	
	
			<p style="color:red;" class="text-center"> Reste : {!! $groupe->tarif-$payment->payment_du_mois !!} DA </p> 	    	

			{{--  --}}
		@endif


		{{--  --}}
	@endforeach
	
	{{--  --}}
@endif
