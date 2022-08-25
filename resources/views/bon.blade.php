<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body style="text-align: center; margin-top:-15%;" >


	<?php use App\Eleve; ?>
	<?php use App\Groupe; ?>

	<?php $eleve = Eleve::find($data['id_eleve']); ?>

	<h1>Ecole</h1>

	<h1>The english Gate</h1>

	The english Gate

	<img src="logo_english_gate.png" width="100px" alt="image">

	<h3>Eleve : {!! $eleve->nom !!} {!! $eleve->prenom !!}</h3>
	
	<h3>Montant payé : {!! $data['montant'] !!} DA</h3>
	
	<h3>Mois N : {!! $data['mois'] !!} | Groupe : #{!! $data['id_groupe'] !!} </h3> 
	<h3> Matière : {!! Groupe::get_matiere($data['id_groupe']) !!} </h3>


</body>
</html>