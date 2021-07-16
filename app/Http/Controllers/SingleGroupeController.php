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
        

        //DB::update("update")

        // code...
    }

    //
}
