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

Route::get('/lang/{lang}', 'LangController@setLang');
