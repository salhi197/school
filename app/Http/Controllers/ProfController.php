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

        return view('Home.profs',compact('profs','last_id'));


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
    	$max = ($request->max);
    	$nom = ($request->nom);

    	//DB::insert("insert into profs(num,nb_places_min,nb_places_max) values(\"$nom\",\"$min\",\"$max\")");

    	# code...
    }

    //



    //
}
