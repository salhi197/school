@extends('layouts.app')

@section('content')
	
	<div class="page-header">
		<h4 class="page-title">Caisse </h4>
	</div>


	<div class="row">

		<div class="col-lg-4 col-md-4 col-sm-12">

			<div class="card">
				<div class="card-header">
					<h5 class="text-center card-title" style="color:#11F966;">Recette</h5>
				</div>
				<div class="card-header">
					<h5 class="text-center card-title">Recette de la semaine : {!! $montant_semaine !!} DA</h5>
				</div>

				<div class="card-header">
					<h5 class="text-center card-title">Recette du dernier mois : 55</h5>
				</div>


				<div class="card-body">
					<div id="echart2" semaines="{!! $les_semaines !!}" montants="{!! $sums !!}" class="chartsh "></div>
				</div>
			</div>
		</div>



		<div class="col-lg-4 col-md-4 col-sm-12">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Gain Net</h5>
				</div>
				<div class="card-body">
					<div id="echart2" class="chartsh "></div>
				</div>
			</div>
		</div>



		<div class="col-lg-4 col-md-4 col-sm-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Les Dépenses</h3>
				</div>
				<div class="card-body">
					<div id="echart2" class="chartsh "></div>
				</div>
			</div>
		</div>

	</div>



	{{--  --}}
@endsection