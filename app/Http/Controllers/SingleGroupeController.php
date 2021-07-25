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

        $data=($request->all());

        $eleves_groupe = $data["eleves_groupe"];
        $groupe = $data["groupe"];
        $seances_eleves = $data["seances_eleves"];
        $numero_de_la_seance_dans_le_mois = $data["numero_de_la_seance_dans_le_mois"];
        $les_coches = $data["les_coches"];
        $id_groupe = $groupe["id"];

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
    
        $le_mois = Groupe::get_the_month($id_groupe);

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
            
            (DB::update("update seances_eleves set presence = \"$presence\" ,num_seance =num_seance+1 where id_eleve = \"$id_eleve\" and id_seance = \"$id_dernier_seance_du_groupe\" "));

            (DB::insert("insert into seances_eleves(num_seance,paye,payement,id_seance,id_eleve) values(\"$num_seance_groupe\",1,2000,\"$last_id_seance\",\"$id_eleve\") "));
    
            if(!empty($data["les_input_payement"]))
            {

                (DB::insert("insert into payment_groupes_eleves(id_groupe,id_eleve,num_seance,payement,num_mois) values(\"$id_groupe\",\"$id_eleve\",\"$num_seance_groupe\",\"$payement\",\"$le_mois\") "));
            }

            // code...
        }

        
        // code...
    }

    //
}
