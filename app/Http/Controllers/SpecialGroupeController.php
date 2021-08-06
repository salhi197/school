<?php

namespace App\Http\Controllers;

use App\Groupe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;


class SpecialGroupeController extends Controller
{
 
    public function index()
    {
        
        $annee_scolaire=(Groupe::get_annee_scolaire());
        
        $groupes_speciaux=Groupe::all_groupes_speciaux();

        $last_id = Groupe::last_special_groupe_ids();

        $salles=DB::select("select * from classes where visible =1 order by num");

        $matieres=DB::select("select * from matieres order by nom /*where visible =1*/");

        $profs=DB::select("select * from profs where visible = 1");

        $niveaux=DB::select("select * from niveaux where visible = 1");
    
        $eleves_groupe = DB::select("select s.id_groupe,count(DISTINCT s.id_groupe,e.id,e.nom,e.prenom,e.num_tel) as nb_eleves from eleves e, seances_eleves se , seances s where (s.id = se.id_seance and se.id_eleve=e.id ) group by s.id_groupe ");

        return view('Home.groupes',compact('groupes','last_id','salles','matieres','profs','niveaux','annee_scolaire','eleves_groupe'));

        

        // code...
    }

    //
}
