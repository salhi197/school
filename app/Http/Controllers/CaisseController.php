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


class CaisseController extends Controller
{

    public function index()
    {

        $annee_scolaire = Groupe::get_annee_scolaire();

        $recettes_semaines_groupe = (DB::select("select week(pg.created_at) as semaine,sum(payement) as montant from payment_groupes_eleves pg, groupes g where (pg.id_groupe=g.id) and (g.annee_scolaire = '$annee_scolaire') group by semaine order by semaine"));
        
        $recettes_semaines_groupe_special = (DB::select("select week(pg.created_at) as semaine,sum(payement) as montant from payement_groupe_special_eleve pg, special_groupes g where (pg.id_groupe_special=g.id) and (g.annee_scolaire = '$annee_scolaire') group by semaine order by semaine"));

        $recettes_semaines_dawra = (DB::select("select week(created_at) as semaine,sum(montant) as montant from dawrapayments group by semaine order by semaine"));

        $recette_frais = DB::select("select week(updated_at) as semaine, sum(frais) as montant from eleves group by semaine order by semaine");

        $les_semaines = [];
        $i=0;

        $sums=[];
        $j=0;

        foreach($recettes_semaines_groupe as $semaine)
        {

            $les_semaines[$i] = $semaine->semaine;
            $i++;
            
            $sum=0;

            foreach (array_merge($recettes_semaines_groupe,$recettes_semaines_groupe_special,$recettes_semaines_dawra,$recette_frais) as $mont) 
            {
                   
                if ($mont->semaine == $semaine->semaine) 
                {

                    $sum=$sum+$mont->montant;

                    $sums[$j] = $sum;

                    // code...
                }

                //
            }

            $j++;

            #
        }        

        $semaine_courante = (DB::select("select week(now()) as semaine_courante"));

        $semaine_courante = $semaine_courante[0]->semaine_courante;

        $key = array_search ($semaine_courante, $les_semaines);

        $montant_semaine = isset($sums[$key]) ? $sums[$key] : 0;
        
        $les_semaines = json_encode($les_semaines);
        
        $sums = json_encode($sums);

        return view('Home.caisse',compact('les_semaines','sums','semaine_courante','montant_semaine'));

        // code...
    }

    //
}
