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
        
        $groupes=Groupe::all_groupes_speciaux();

        $last_id = Groupe::last_special_groupe_ids();

        $salles=DB::select("select * from classes where visible =1 order by num");

        $matieres=DB::select("select * from matieres order by nom /*where visible =1*/");

        $profs=DB::select("select * from profs where visible = 1");

        $niveaux=DB::select("select * from niveaux where visible = 1");
        
        $eleves_groupe = DB::select("select s.id_groupe_special,count(DISTINCT s.id_groupe_special,e.id,e.nom,e.prenom,e.num_tel) as nb_eleves from eleves e, seances_speciales_eleves se , seances_speciales s where (s.id = se.id_seance_speciale and se.id_eleve=e.id ) group by s.id_groupe_special ");
        
        return view('Home.groupes_special',compact('groupes','last_id','salles','matieres','profs','niveaux','annee_scolaire','eleves_groupe'));

        

        // code...
    }


    public function ajouter(Request $request)
    {

        set_time_limit(0);

        ini_set('memory_limit', '-1');

        $annee_scolaire=(Groupe::get_annee_scolaire());

        $prctg_ecole = 100-$request->pourcentage_prof;

        DB::insert("insert into special_groupes(jour,heure_debut,heure_fin,salle,niveau,pourcentage_prof,pourcentage_ecole,tarif,annee_scolaire) values(\"$request->jour\",\"$request->heure_debut\",\"$request->heure_fin\",\"$request->salle\",\"$request->niveau\",\"$request->pourcentage_prof\",\"$prctg_ecole\",\"$request->tarif\",\"$annee_scolaire\")");

        $last = DB::select("select * from special_groupes order by id desc");

        $id_last_groupe = $last[0]->id;

        DB::insert("insert into seances_speciales(id_groupe_special,num,id_prof) values (\"$id_last_groupe\",1,0)");
       
        session()->flash('notification.message' , 'Groupe Spécial : '.$id_last_groupe.' , '.$request->niveau.' ajoutée avec succés');

        session()->flash('notification.type' , 'success'); 

        return back();

        # code...



        // code...
    }


    //
}
