<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;


class Eleve extends Model
{

    public static function add_eleve($id_groupe,$nom,$prenom,$num_tel,$payement,$cotisations)
    {

        $il_paye = ($cotisations);

        $le_mois = (Groupe::get_the_month($id_groupe));

        $dernier_seance_du_groupe = (DB::select("select num as derniere_seance from seances where id_groupe = \"$id_groupe\" order by num desc "));
        
        if(count($dernier_seance_du_groupe)>0)
        {
            $dernier_seance_du_groupe = $dernier_seance_du_groupe[0]->derniere_seance;
            //
        }
        else
        {
            $dernier_seance_du_groupe = 0;
        }

        $id_dernier_seance_du_groupe = (DB::select("select id as id_derniere_seance from seances where id_groupe = \"$id_groupe\" order by id desc "));
        
        if(count($id_dernier_seance_du_groupe)>0)
        {
            $id_dernier_seance_du_groupe = $id_dernier_seance_du_groupe[0]->id_derniere_seance;
            //
        }
        else
        {
            dd("makach seance");
        }

        $last = (DB::select("select * from eleves where (nom=\"$nom\" and prenom=\"$prenom\")or(nom=\"$prenom\" and nom=\"$prenom\") "));

        if (count($last)>0) 
        {
            
            $id_eleve = $last[0]->id;         

            // code...
        }
        else
        {
    
            DB::insert("insert into eleves(nom,prenom,num_tel) values(\"$nom\",\"$prenom\",\"$num_tel\") ");

            $last = DB::select("select * from eleves order by id desc");

            $id_eleve = $last[0]->id;

        }
        
        if ($il_paye == 1) 
        {

            DB::insert("insert into payment_groupes_eleves (id_groupe,id_eleve,num_seance,payement,num_mois) values (\"$id_groupe\",\"$id_eleve\",\"$dernier_seance_du_groupe\",\"$payement\",\"$le_mois\")");
        
            //
        }
        else
        {

            DB::insert("insert into payment_groupes_eleves (id_groupe,id_eleve,num_seance,payement,num_mois,paye) values (\"$id_groupe\",\"$id_eleve\",\"$dernier_seance_du_groupe\",\"$payement\",\"$le_mois\",0)");
            //
        }

        DB::insert("insert into seances_eleves (num_seance,paye,payement,presence,id_seance,id_eleve) values (\"$dernier_seance_du_groupe\",1,\"$payement\",0,\"$id_dernier_seance_du_groupe\",\"$id_eleve\") ");

        

        session()->flash('notification.message' , 'Elève : '.$last[0]->nom.' , '.$last[0]->prenom.' ajoutée avec succés');

        session()->flash('notification.type' , 'success');

        //
    }

    //use HasFactory;
}
