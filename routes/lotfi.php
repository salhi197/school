<?php

Route::group(['middleware' => 'auth'], function () 
{

	Route::get('/home/calendrier','CalendrierController@index');

	Route::get('/home/inscriptions','InscriptionController@index');

	Route::get('/home/groupes/{id}/payer_prof','SingleGroupeController@payer_prof1');

	Route::get('/home/groupes_special/{id}/payement_prof','SpecialGroupeController@payement_prof');

	Route::post('/home/groupes/modifier','SingleGroupeController@modifier_groupe');

	Route::post('/home/groupes/fit_salle/modifier/ajax','SingleGroupeController@fit_salles');

	Route::post('/home/single_eleve/supprimer/ajax','SingleGroupeController@supprimer_eleve');

	Route::get('/home/particuliers','ParticulierController@index');

	Route::post('/home/Enseignants/verif_existance/ajax','ProfController@verif_existance');

	Route::post('/home/groupes/{id_groupe}/eleve/{id_eleve}/modif_num','SingleGroupeController@modifier_eleve');

	//
});	