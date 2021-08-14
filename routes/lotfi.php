<?php

Route::group(['middleware' => 'auth'], function () 
{

	Route::get('/home/particulier','ParticulierController@index');

	Route::get('/home/groupes/{id}/payer_prof','SingleGroupeController@payer_prof1');

	//
});	