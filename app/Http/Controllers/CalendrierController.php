<?php

namespace App\Http\Controllers;

use App\Classe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;


class CalendrierController extends Controller
{

    public function index()
    {

        $salles = DB::select("select * from classes where visible = 1 order by num");

        $salles_profs_dimanche = (DB::select("select classe,matiere,prof,heure_debut,heure_fin,niveau,rank() over (partition by classe order by heure_debut asc) as ordre from groupes where visible = 1 and jour = 'Dimanche' order by classe,heure_debut"));
        
        $horaires_dimanche = (DB::select("select distinct heure_debut,heure_fin from groupes where visible = '1' and jour = 'Dimanche' order by heure_debut"));
        

        $salles_profs_lundi = (DB::select("select classe,matiere,prof,heure_debut,heure_fin,niveau,rank() over (partition by classe order by heure_debut asc) as ordre from groupes where visible = 1 and jour = 'Lundi' order by classe,heure_debut"));
        
        $horaires_lundi = (DB::select("select distinct heure_debut,heure_fin from groupes where visible = '1' and jour = 'Lundi' order by heure_debut"));


        $salles_profs_mardi = (DB::select("select classe,matiere,prof,heure_debut,heure_fin,niveau,rank() over (partition by classe order by heure_debut asc) as ordre from groupes where visible = 1 and jour = 'Mardi' order by classe,heure_debut"));
        
        $horaires_mardi = (DB::select("select distinct heure_debut,heure_fin from groupes where visible = '1' and jour = 'Mardi' order by heure_debut"));



        $salles_profs_mercredi = (DB::select("select classe,matiere,prof,heure_debut,heure_fin,niveau,rank() over (partition by classe order by heure_debut asc) as ordre from groupes where visible = 1 and jour = 'Mercredi' order by classe,heure_debut"));
        
        $horaires_mercredi = (DB::select("select distinct heure_debut,heure_fin from groupes where visible = '1' and jour = 'Mercredi' order by heure_debut"));




        $salles_profs_jeudi = (DB::select("select classe,matiere,prof,heure_debut,heure_fin,niveau,rank() over (partition by classe order by heure_debut asc) as ordre from groupes where visible = 1 and jour = 'Jeudi' order by classe,heure_debut"));
        
        $horaires_jeudi = (DB::select("select distinct heure_debut,heure_fin from groupes where visible = '1' and jour = 'Jeudi' order by heure_debut"));




        $salles_profs_vendredi = (DB::select("select classe,matiere,prof,heure_debut,heure_fin,niveau,rank() over (partition by classe order by heure_debut asc) as ordre from groupes where visible = 1 and jour = 'Vendredi' order by classe,heure_debut"));
        
        $horaires_vendredi = (DB::select("select distinct heure_debut,heure_fin from groupes where visible = '1' and jour = 'Vendredi' order by heure_debut"));




        $salles_profs_samedi = (DB::select("select classe,matiere,prof,heure_debut,heure_fin,niveau,rank() over (partition by classe order by heure_debut asc) as ordre from groupes where visible = 1 and jour = 'Samedi' order by classe,heure_debut"));
        
        $horaires_samedi = (DB::select("select distinct heure_debut,heure_fin from groupes where visible = '1' and jour = 'Samedi' order by heure_debut"));



        return view('Home.calendrier',compact('salles','salles_profs_dimanche','horaires_dimanche','salles_profs_lundi','horaires_lundi','salles_profs_mardi','horaires_mardi','salles_profs_mercredi','horaires_mercredi','salles_profs_jeudi','horaires_jeudi','salles_profs_vendredi','horaires_vendredi','salles_profs_samedi','horaires_samedi'));

        // code...
    }

    //
}
