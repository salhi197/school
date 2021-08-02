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

        $eleves_groupe = DB::select("select s.id_groupe,count(DISTINCT s.id_groupe,e.id,e.nom,e.prenom,e.num_tel) as nb_eleves from eleves e, seances_eleves se , seances s where (s.id = se.id_seance and se.id_eleve=e.id ) group by s.id_groupe ");

        return view('Home.groupes',compact('groupes','last_id','salles','matieres','profs','niveaux','annee_scolaire','eleves_groupe'));


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

        DB::insert("insert into groupes(jour,heure_debut,heure_fin,classe,matiere,niveau,prof,pourcentage_prof,pourcentage_ecole,tarif,annee_scolaire) values(\"$request->jour\",\"$request->heure_debut\",\"$request->heure_fin\",\"$request->salle\",\"$request->matiere\",\"$request->niveau\",\"$request->prof\",\"$request->pourcentage_prof\",\"$prctg_ecole\",\"$request->tarif\",\"$annee_scolaire\")");

        $last = DB::select("select * from groupes order by id desc");

        $id_last_groupe = $last[0]->id;

        DB::insert("insert into seances(id_groupe,num) values (\"$id_last_groupe\",1)");

       
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
        
        $seances_eleves = DB::select("select e.id as id_eleve,s.id_groupe,s.num as numero_de_la_seance_dans_le_mois,se.num_seance as num_seance_eleve,se.paye,se.presence,se.created_at,se.created_at,e.nom,e.prenom from seances s , seances_eleves se , eleves e where (s.id_groupe = \"$id\") and (se.id_seance=s.id) and (se.id_eleve = e.id) order by e.id,s.num");
        
        $eleves_groupe = DB::select("select DISTINCT e.id,e.nom,e.prenom,e.num_tel from eleves e, seances_eleves se , seances s where ( s.id_groupe = \"$id\" and s.id = se.id_seance and se.id_eleve=e.id ) order by e.id ");

        $nbr_seance_mois = (DB::select("select max(num) as numero_de_la_seance_dans_le_mois from seances where id_groupe = \"$id\" "));

        if (count($nbr_seance_mois)>0) 
        {

            $numero_de_la_seance_dans_le_mois=$nbr_seance_mois[0]->numero_de_la_seance_dans_le_mois;

            // code...
        }
        else
        {

            $numero_de_la_seance_dans_le_mois=0;

            //
        }
        
        $le_mois = (Groupe::get_the_month($id));

        $payments = DB::select("select id_eleve,id_groupe,num_mois,sum(payement) as payment_du_mois from payment_groupes_eleves where id_groupe =\"$id\" and num_mois = \"$le_mois\" group by id_eleve,id_groupe,num_mois order by id_eleve,num_mois"); 

        /*dd($payments);*/

        $ancien_payments = DB::select("select pg.id_eleve,pg.id_groupe,pg.num_mois,sum(payement) as payment_du_mois,sum(exoneree) as exoneree from payment_groupes_eleves pg where id_groupe =\"$id\" and num_mois <> \"$le_mois\" group by pg.id_eleve,pg.id_groupe,pg.num_mois having (sum(payement) <> (select tarif from groupes where id = \"$id\") ) order by id_eleve,num_mois"); 

        //dd($ancien_payments);

        $nb_presences = (DB::select("select FLOOR((s.num-1)/4)+1 as num_mois,count(se.presence) as nb_presence from seances_eleves se, seances s where(se.id_seance=s.id) and (s.id_groupe=\"$id\") and (se.presence = 1) group by FLOOR((s.num-1)/4)+1 "));

        $nom_prenom = (explode('-',$groupe->prof));
        
        $nom = $nom_prenom[0];
        $prenom = $nom_prenom[1];
        
        $numtel = DB::select("select nom,prenom,tel from profs where (nom = \"$nom\" and prenom = \"$prenom\") or (nom = \"$prenom\" and prenom = \"$nom\") ");
        
        $numtel = $numtel[0];
        
        return view('Home.single_groupe',compact('groupe','eleves_groupe','seances_eleves','numero_de_la_seance_dans_le_mois','id','payments','ancien_payments','le_mois','nb_presences','numtel'));

        // code...
    }

    public function ajouter_eleve($id,Request $request)
    {

        $le_mois = (Groupe::get_the_month($id));

        $dernier_seance_du_groupe = (DB::select("select max(num) as derniere_seance from seances where id_groupe = \"$id\" "));

        if(count($dernier_seance_du_groupe)>0)
        {
            $dernier_seance_du_groupe = $dernier_seance_du_groupe[0]->derniere_seance;
            //
        }
        else
        {
            $dernier_seance_du_groupe = 0;
        }

        $id_dernier_seance_du_groupe = (DB::select("select max(id) as id_derniere_seance from seances where id_groupe = \"$id\" "));
        
        if(count($id_dernier_seance_du_groupe)>0)
        {
            $id_dernier_seance_du_groupe = $id_dernier_seance_du_groupe[0]->id_derniere_seance;
            //
        }
        else
        {
            dd("makach seance");
        }

        DB::insert("insert into eleves(nom,prenom,num_tel) values(\"$request->nom\",\"$request->prenom\",\"$request->num_tel\") ");

        $last = DB::select("select * from eleves order by id desc");

        $id_eleve = $last[0]->id;

        DB::insert("insert into payment_groupes_eleves (id_groupe,id_eleve,num_seance,payement,num_mois) values (\"$id\",\"$id_eleve\",\"$dernier_seance_du_groupe\",\"$request->payment\",\"$le_mois\")");

        DB::insert("insert into seances_eleves (num_seance,paye,payement,presence,id_seance,id_eleve) values (\"$dernier_seance_du_groupe\",1,\"$request->payment\",0,\"$id_dernier_seance_du_groupe\",\"$id_eleve\") ");

        
        session()->flash('notification.message' , 'Elève : '.$last[0]->nom.' , '.$last[0]->prenom.' ajoutée avec succés');

        session()->flash('notification.type' , 'success'); 

        return back();

        // code...
    }


    //



    //
}
