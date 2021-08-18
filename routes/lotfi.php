<?php

Route::group(['middleware' => 'auth'], function () 
{

	Route::get('/home/calendrier','CalendrierController@index');

	Route::get('/home/groupes/{id}/payer_prof','SingleGroupeController@payer_prof1');

	Route::get('/home/groupes_special/{id}/payement_prof','SpecialGroupeController@payement_prof');

	//
});	