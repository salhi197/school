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


class GroupeController extends Controller
{

    public function groupes()
    {

        $annee_scolaire=(Groupe::get_annee_scolaire());
        
        $groupes=Groupe::all_groupes();

        $last_id = Groupe::last_ids();

        $salles=DB::select("select * from classes where visible =1 order by num");

        $matieres=DB::select("select * from matieres /*where visible =1*/");

        $profs=DB::select("select * from profs where visible = 1");

        $niveaux=DB::select("select * from niveaux where visible = 1");

        return view('Home.groupes',compact('groupes','last_id','salles','matieres','profs','niveaux','annee_scolaire'));


        # code...
    }

    public function fit_salles(Request $request)
    {

        $annee_scolaire=(Groupe::get_annee_scolaire());

        $dispo=(DB::select("select * from groupes where jour = \"$request->jour\" and classe=\"$request->salle\" and visible = 1 and annee_scolaire = \"$annee_scolaire\""));

        $debut = strtotime($request->debut);
        $fin = strtotime($request->fin);

        foreach ($dispo as $disp) 
        {

            $time_debut = strtotime($disp->heure_debut);
            $time_fin = strtotime($disp->heure_fin);


            if(($debut>=$time_debut && $fin<=$time_fin)||
            ($time_debut<=$debut && $time_fin>=$fin)||
            ($debut>=$time_debut && $debut<$time_fin && $fin>=$time_fin)||
            ($debut<=$time_debut && $fin<=$time_fin && $fin>$time_debut)) 

            {
             
                return response()->json($disp);

                // code...
            }

            // code...
        }
        
        return response()->json(true);
        // code...
    }

    public function modifier(Request $request)
    {

    	DB::update("update groupes set tel = \"$request->tel\" where id = \"$request->id\" ");

    	# code...
    }

    public function supprimer(Request $request)
    {

    	DB::update("update groupes set visible = 0 where id = \"$request->id\" ");

    	# code...
    }

    public function ajouter(Request $request)
    {   
        
        $annee_scolaire=(Groupe::get_annee_scolaire());

        $prctg_ecole = 100-$request->pourcentage_prof;

        DB::insert("insert into groupes(jour,heure_debut,heure_fin,classe,matiere,niveau,prof,pourcentage_prof,pourcentage_ecole,annee_scolaire) values(\"$request->jour\",\"$request->heure_debut\",\"$request->heure_fin\",\"$request->salle\",\"$request->matiere\",\"$request->niveau\",\"$request->prof\",\"$request->pourcentage_prof\",\"$prctg_ecole\",\"$annee_scolaire\")");

       
       session()->flash('notification.message' , 'Groupe : '.$request->matiere.' , '.$request->niveau.' Prof : '.$request->prof.' ajoutée avec succés');

       session()->flash('notification.type' , 'success'); 

       return back();

    	# code...
    }

    public function get_profs(Request $request)
    {
      


        $profs1=DB::select("select * from profs where (matiere = \"$request->matiere\" and cycle=\"$request->cycle\") and visible = 1 ");

        $profs2=DB::select("select * from profs where (matiere <> \"$request->matiere\" or cycle <> \"$request->cycle\") and visible = 1 ");
        
        $tous=array_merge($profs1,$profs2);

        return response()->json($tous);
        // code...
    }

    public function afficher_groupe($id)
    {

        $groupe = (DB::select("select * from groupes where id = \"$id\" "));

        $groupe = $groupe[0];

        $seances_eleves = DB::select("select s.id_groupe,s.num as numero_de_la_seance_dans_le_mois,se.num_seance as num_seance_eleve,se.paye,se.presence,se.date,se.heure,e.nom,e.prenom from seances s , seances_eleves se , eleves e where (s.id_groupe = \"$id\") and (se.id_seance=s.id) and (se.id_eleve = e.id) ");

        $eleves_groupe = DB::select("select DISTINCT e.id,e.nom,e.prenom from eleves e, seances_eleves se , seances s where ( s.id_groupe = \"$id\" and s.id = se.id_seance and se.id_eleve=e.id ) ");

        return view('Home.single_groupe',compact('groupe','eleves_groupe','seances_eleves'));

        // code...
    }


    //



    //
}
