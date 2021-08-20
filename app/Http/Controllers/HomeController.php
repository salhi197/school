<?php

namespace App\Http\Controllers;

use App\Classe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\User;


class HomeController extends Controller
{

    public function ChangePassword(Request $request)
    {
        DB::table('users')
            ->where('id', 1)
            ->update(['password' => Hash::make($request['password']),'password_text' => $request['password']]);

        session()->flash('notification.message' , 'Dawra : '.$request->matiere.' , '.$request->niveau.' Prof : '.$request->prof.' ajoutée avec succés');
        session()->flash('notification.type' , 'success'); 
        return back();            
    }
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */
    
    public function index()
    {   
        $ecole = (DB::select("select * from ecoles"));
        $user = User::find(1);
        $password_text = $user->password_text;
        return view('home',compact('ecole','password_text'));
    }

    public function saisir_frais(Request $request)
    {

        DB::update("update ecoles set frais = '$request->frais' ");

        return back();

        // code...
    }

    //
}
