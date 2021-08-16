<?php

namespace App\Http\Controllers;

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

        //dd(DB::select("select nom,prenom,rank() over(partition by nom order by nom)sales_rank from eleves group by nom,prenom"));
        
        $horaires = (DB::select("select distinct heure_debut,heure_fin from groupes where jour = 'Dimanche' order by heure_debut"));
        $salles = DB::select("select * from classes where visible = 1 order by num");

        
        $salles_profs_dimanche = (DB::select("select classe,matiere,prof,heure_debut,heure_fin from groupes where jour = 'Dimanche' order by classe,heure_debut"));

        $salles_profs_dimanches = (DB::select("select distinct heure_debut,heure_fin from groupes where visible = '1' and jour = 'Dimanche' order by heure_debut"));        

        $salles_profs_lundi = (DB::select("select classe,matiere,prof,heure_debut,heure_fin from groupes where visible = '1' and jour = 'Lundi' order by heure_debut"));

        $salles_profs_lundis = (DB::select("select distinct heure_debut,heure_fin from groupes where visible = '1' and jour = 'Lundi' order by heure_debut"));

        $salles_profs_mardi = (DB::select("select classe,matiere,prof,heure_debut,heure_fin from groupes where visible = '1' and jour = 'Mardi' order by heure_debut"));

        $salles_profs_mardis = (DB::select("select distinct heure_debut,heure_fin from groupes where visible = '1' and jour = 'Mardi' order by heure_debut"));

        $salles_profs_mercredi = (DB::select("select classe,matiere,prof,heure_debut,heure_fin from groupes where visible = '1' and jour = 'Mercredi' order by heure_debut"));

        $salles_profs_mercredis = (DB::select("select distinct heure_debut,heure_fin from groupes where visible = '1' and jour = 'Mercredi' order by heure_debut"));

        $salles_profs_jeudi = (DB::select("select classe,matiere,prof,heure_debut,heure_fin from groupes where visible = '1' and jour = 'Jeudi' order by heure_debut"));

        $salles_profs_jeudis = (DB::select("select distinct heure_debut,heure_fin from groupes where visible = '1' and jour = 'Jeudi' order by heure_debut"));

        $salles_profs_vendredi = (DB::select("select classe,matiere,prof,heure_debut,heure_fin,rank() over(partition by classe order by heure_debut asc) rank from groupes where visible = '1' and jour = 'Vendredi' group by classe,matiere,prof,heure_debut,heure_fin order by classe"));

        dd($salles_profs_vendredi);
        
        $salles_profs_vendredis = (DB::select("select distinct heure_debut,heure_fin from groupes where visible = '1' and jour = 'Vendredi' order by heure_debut"));

        $salles_profs_samedi = (DB::select("select classe,matiere,prof,heure_debut,heure_fin from groupes where visible = '1' and jour = 'Samedi' order by heure_debut"));
        //dd($salles_profs_samedi);
        $salles_profs_samedis = (DB::select("select distinct heure_debut,heure_fin from groupes where visible = '1' and jour = 'Samedi' order by heure_debut"));
        
        return view('Home.calendrier',compact('horaires','salles','salles_profs_dimanche','salles_profs_lundi','salles_profs_mardi','salles_profs_mercredi','salles_profs_jeudi','salles_profs_vendredi','salles_profs_samedi','salles_profs_dimanches','salles_profs_lundis','salles_profs_mardis','salles_profs_mercredis','salles_profs_jeudis','salles_profs_vendredis','salles_profs_samedis'));

        // code...
    }

    //
}
