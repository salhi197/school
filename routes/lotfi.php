<?php

Route::group(['middleware' => 'auth'], function () 
{

	Route::get('/home/particulier','ParticulierController@index');

	//
});	