<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->middleware('lang');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

//classes :
Route::get('/home/classes', 'ClasseController@classes');
Route::post('/home/classes/modifier/ajax','ClasseController@modifier');
Route::post('/home/classes/supprimer/ajax','ClasseController@supprimer');
Route::post('/home/classes/ajouter/ajax','ClasseController@ajouter');

//niveaux :
Route::get('/home/niveaux', 'NiveauController@niveaux');
Route::post('/home/niveaux/modifier/ajax','NiveauController@modifier');
Route::post('/home/niveaux/supprimer/ajax','NiveauController@supprimer');
Route::post('/home/niveaux/ajouter/ajax','NiveauController@ajouter');


//matiéres :
Route::get('/home/matiéres', 'MatiereController@matieres');
Route::post('/home/matieres/modifier/ajax','MatiereController@modifier');
Route::post('/home/matieres/supprimer/ajax','MatiereController@supprimer');
Route::post('/home/matieres/ajouter/ajax','MatiereController@ajouter');


//Profs :
Route::get('/home/Enseignants', 'ProfController@profs');
Route::post('/home/profs/modifier/ajax','ProfController@modifier');
Route::post('/home/profs/supprimer/ajax','ProfController@supprimer');
Route::post('/home/profs/ajouter/ajax','ProfController@ajouter');


//Groupes : 
Route::get('/home/groupes','GroupeController@groupes');
Route::get('/home/groupes/{id}','GroupeController@afficher_groupe');
Route::post('/home/groupes/{id}/ajouter','GroupeController@ajouter_eleve');
Route::post('/home/single_groupe/valider_coches/ajax','SingleGroupeController@valider_coches');

Route::post('/home/groupes/modifier/ajax','GroupeController@modifier');
Route::post('/home/groupes/supprimer/ajax','GroupeController@supprimer');
Route::post('/home/groupes/ajouter/ajax','GroupeController@ajouter');
Route::post('/home/groupes/get_profs/ajax','GroupeController@get_profs');
Route::post('/home/groupes/fit_salle/ajax','GroupeController@fit_salles');

//payement : 

Route::get('/home/groupes/{id_groupe}/eleve/{id_eleve}','SingleGroupeController@historique_payement');
Route::post('/home/single_eleve/exoneree/ajax','SingleGroupeController@exonerer');
Route::post('/home/single_eleve/completer_payement/ajax','SingleGroupeController@completer_payement');

// dawarat :

Route::get('/home/dawarat','DawraController@dawrat');
Route::post('/home/dawra/ajouter','DawraController@ajouter');
Route::get('/home/dawra/{id}','DawraController@afficher_dawra');
Route::post('/home/dawra/{id}/ajouter','DawraController@ajouter_eleve');










Route::get('/lang/{lang}', 'LangController@setLang');
