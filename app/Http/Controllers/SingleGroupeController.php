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

class SingleGroupeController extends Controller
{

    public function valider_coches(Request $request)
    {

        set_time_limit(0);

        ini_set('memory_limit', '-1');

        ini_set('max_input_vars','5500');

        $data = $request->all();
        
        $eleves_groupe = $data["eleves_groupe"];
        $groupe = $data["groupe"];
        $numero_de_la_seance_dans_le_mois = $data["numero_de_la_seance_dans_le_mois"];
        $les_coches = $data["les_coches"];
        $eleves_gratuits = $data["eleves_gratuits"];
        
        $id_groupe = $groupe;

        $le_mois = Groupe::get_the_month($id_groupe);

        if(!empty($data["les_input_payement"]))
        {
            $les_input_payement = $data["les_input_payement"];
        }

        $id_dernier_seance_du_groupe = (DB::select("select max(id) as id_derniere_seance from seances where id_groupe = \"$id_groupe\" "));
        
        $num_seance_groupe = DB::select("select max(num) as numero_de_la_derniere_seance_du_groupe from seances where id_groupe = \"$id_groupe\" ");

        $num_seance_groupe = $num_seance_groupe[0]->numero_de_la_derniere_seance_du_groupe;

        $seance_prochaine = $num_seance_groupe+1;

        if(count($id_dernier_seance_du_groupe)>0)
        {
            $id_dernier_seance_du_groupe = $id_dernier_seance_du_groupe[0]->id_derniere_seance;
            //
        }


        DB::insert("insert into seances (id_groupe,num) values (\"$id_groupe\",\"$seance_prochaine\" ) ");        
        
        $last = DB::select("select max(id) as last_id from seances where id_groupe = \"$id_groupe\" ");
        
        $last_id_seance = $last[0]->last_id;

        for ($i=0; $i<count($les_coches); $i++) 
        {
            
            $presence = $les_coches[$i];

            $id_eleve = (int)$eleves_groupe[$i]["id"]; 

            if($les_input_payement[$i]==null)
            {
                $payement = 0;
            }
            else
            {
                $payement = $les_input_payement[$i];   
            }
            
            $now=(DB::select("select now() as datetime"));

            $now = $now[0]->datetime;

            $esq_gratuit = 0;

            foreach ($eleves_gratuits as $eleve_gratuit) 
            {
                
                if ($eleve_gratuit['id_eleve'] == $id_eleve ) 
                {

                    if ($presence == 1) 
                    {
                        
                        (DB::update("update seances_eleves set presence = 2 ,num_seance =num_seance+1,created_at = \"$now\"  where id_eleve = \"$id_eleve\" and id_seance = \"$id_dernier_seance_du_groupe\" "));

                        //
                    }
                    elseif($presence == 0)
                    {

                        (DB::update("update seances_eleves set presence = 0 ,num_seance =num_seance+1,created_at = \"$now\"  where id_eleve = \"$id_eleve\" and id_seance = \"$id_dernier_seance_du_groupe\" "));

                        //
                    }


                    $esq_gratuit++;

                    // code...
                }

                //
            }

            if ($esq_gratuit==0) 
            {
                
                (DB::update("update seances_eleves set presence = \"$presence\" ,num_seance =num_seance+1,created_at = \"$now\"  where id_eleve = \"$id_eleve\" and id_seance = \"$id_dernier_seance_du_groupe\" "));
                
                // code...
            }


            (DB::insert("insert into seances_eleves(num_seance,paye,payement,id_seance,id_eleve) values(\"$num_seance_groupe\",1,2000,\"$last_id_seance\",\"$id_eleve\") "));
    
            if(!empty($data["les_input_payement"]))
            {

                (DB::insert("insert into payment_groupes_eleves(id_groupe,id_eleve,num_seance,payement,num_mois) values(\"$id_groupe\",\"$id_eleve\",\"$num_seance_groupe\",\"$payement\",\"$le_mois\") "));
            }

            // code...
        }

        
        // code...
    }

    public function historique_payement($id_groupe,$id_eleve)
    {

        set_time_limit(0);

        ini_set('memory_limit', '-1');


        $groupe = DB::select("select * from groupes where id = \"$id_groupe\" ");
        $groupe = $groupe[0];
        
        $eleve = DB::select("select * from eleves where id = \"$id_eleve\" ");
        $eleve = $eleve[0];
        
        $le_mois = Groupe::get_the_month($id_groupe);

        $payement_eleve = DB::select("select * from payment_groupes_eleves where id_eleve = \"$id_eleve\" and payement <> 0 order by num_mois,created_at ");

        $seances_eleves = DB::select("select se.id_eleve,se.presence,s.num,se.created_at from seances_eleves se, seances s where (se.id_seance=s.id) and (s.id_groupe = \"$id_groupe\") and (id_eleve = \"$id_eleve\") order by s.num ");
        
        $les_presences = DB::select("select se.id_eleve,FLOOR((s.num-1)/4)+1 as mois,count(presence) as presences from seances_eleves se,seances s where (se.id_seance = s.id) and (se.id_eleve = \"$id_eleve\") and (s.id_groupe = \"$id_groupe\") and (se.presence = 1) group by se.id_eleve,s.num");

        $les_absences = DB::select("select se.id_eleve,FLOOR((s.num-1)/4)+1 as mois,count(presence) as presences from seances_eleves se,seances s where (se.id_seance = s.id) and (se.id_eleve = \"$id_eleve\") and (s.id_groupe = \"$id_groupe\") and (se.presence = 0) group by se.id_eleve,s.num");

        //dump($les_absences);
        //dd($les_presences);

        $retards = DB::select("select pg.id_eleve,pg.id_groupe,pg.num_mois,sum(payement) as payment_du_mois,sum(exoneree) as exoneree from payment_groupes_eleves pg where id_groupe =\"$id_groupe\"  and pg.id_eleve=\"$id_eleve\" group by pg.id_eleve,pg.id_groupe,pg.num_mois order by id_eleve,num_mois"); 
        
        $current = (Groupe::current_seance($groupe->id));
        //dd($retards);
        return view('Home.single_eleve',compact('groupe','eleve','payement_eleve','seances_eleves','le_mois','les_presences','les_absences','retards','current'));

        // code...
    }

    public function exonerer(Request $request)
    {

        set_time_limit(0);

        ini_set('memory_limit', '-1');


        $data = ($request->all());
            
        $id_groupe = $data["id_groupe"];
        $id_eleve = $data["id_eleve"];
        $num_mois = $data["num_mois"];

        dump(DB::update("update payment_groupes_eleves set exoneree = 1 where (id_groupe = \"$id_groupe\") and (id_eleve = \"$id_eleve\") and (num_mois=\"$num_mois\")"));

        // code..
    }   

    public function completer_payement(Request $request)
    {

        set_time_limit(0);

        ini_set('memory_limit', '-1');


        $data = ($request->all());

        $id_groupe = $data["id_groupe"];
        $id_eleve = $data["id_eleve"];
        $current_seance = $data["current_seance"];
        $payement = $data["payement"];
        $num_mois = $data["num_mois"];
        
        dump(DB::insert("insert into payment_groupes_eleves(id_groupe,id_eleve,num_seance,payement,num_mois) values(\"$id_groupe\",\"$id_eleve\",\"$current_seance\",\"$payement\",\"$num_mois\") "));
        
        //
    }

    public function toutes_seances($id_groupe)
    {

        $id=($id_groupe);

        set_time_limit(0);

        ini_set('memory_limit', '-1');

        $groupe = (DB::select("select * from groupes where id = \"$id\" "));

        $groupe = $groupe[0];

        $this_mois = (Groupe::get_the_month($groupe->id));
        
        $seances_eleves = DB::select("select e.id as id_eleve,s.id_groupe,s.num as numero_de_la_seance_dans_le_mois,se.presence,se.created_at from seances s , seances_eleves se , eleves e where (s.id_groupe = \"$id\") and (se.id_seance=s.id) and (se.id_eleve = e.id) /*and ((FLOOR((s.num-1)/4)+1)=\"$this_mois\" or (FLOOR((s.num-1)/4)+1)=\"$this_mois-1\" or (FLOOR((s.num-1)/4)+1)=\"$this_mois+1\" )*/ order by e.nom,e.prenom,s.num");
        
        $eleves_groupe = DB::select("select DISTINCT e.id,e.nom,e.prenom,e.num_tel from eleves e, seances_eleves se , seances s where ( s.id_groupe = \"$id\" and s.id = se.id_seance and se.id_eleve=e.id ) order by e.nom,e.prenom ");

        $nbr_seance_mois = (DB::select("select num as numero_de_la_seance_dans_le_mois from seances where id_groupe = \"$id\" order by num desc "));

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

        return view('Home.single_groupe_complet',compact('groupe','eleves_groupe','seances_eleves','numero_de_la_seance_dans_le_mois','id','payments','ancien_payments','le_mois','nb_presences','numtel'));


        // code...
    }

    //
}
