<?php

namespace App\Http\Controllers;

use App\Prof;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;


class ProfController extends Controller
{

    public function profs()
    {
        
        $profs=Prof::all_profs();

        $last_id = Prof::last_ids();

        $matieres = DB::select("select * from matieres order by nom");

        return view('Home.profs',compact('profs','last_id','matieres'));


        # code...
    }

    public function modifier(Request $request)
    {

    	DB::update("update profs set tel = \"$request->tel\" where id = \"$request->id\" ");

    	# code...
    }

    public function supprimer(Request $request)
    {

    	DB::update("update profs set visible = 0 where id = \"$request->id\" ");

    	# code...
    }

    public function ajouter(Request $request)
    {   
        
    	$nom = ($request->nom);
        $prenom = ($request->prenom);
        $tel = ($request->tel);
        $cycle = ($request->cycle);
        $matiere = ($request->matiere);

    	DB::insert("insert into profs(nom,prenom,cycle,tel,matiere) values(\"$nom\",\"$prenom\",\"$cycle\",\"$tel\",\"$matiere\")");

    	# code...
    }

    //



    //
}
