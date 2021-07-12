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

class Groupe extends Model
{
    
    public static function all_groupes()
    {

        $annee_scolaire=(Groupe::get_annee_scolaire());

        $all_groupes = (DB::select("select * from groupes where visible =1 and annee_scolaire=\"$annee_scolaire\" order by id"));

        return $all_groupes;
        # code...
    }

    public static function last_ids()
    {

        $all_groupes = (DB::select("select * from groupes /*where visible =1*/ order by id desc"));

        if (count($all_groupes)==0) 
        {
        
            return 0;
            
            # code...
        }
        else
        {

            return $all_groupes[0]->id;         

            # code...   
        }

        # code...
    }

    public static function get_annee_scolaire()
    {

        $cette_annee = (date('y'));

        $prochaine_annee = $cette_annee+1;

        $precedente_annee = $cette_annee-1;

        if(date('m')>6 && date('m')<12)
        {

            return $cette_annee."/".$prochaine_annee;

            //
        }
        else
        {

            return $precedente_annee."/".$cette_annee;

            //
        }

        // code...
    }







    //use HasFactory;
}
