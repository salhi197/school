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
use App\Eleve;
use PDF;

class HomeController extends Controller
{

    public function sync(Request $request)
    {
        $tables = $request['database'];
        $f = collect();
        foreach ($tables as $table) {
            $name = $table['table'];
            DB::table($name)->truncate();
            if(isset($table['data'])){
                foreach($table['data'] as $data){
                    $f->push($data);
                    DB::table($name)->insert((array) $data);
                }    
            }
        }        
        return response()->json($f); 
    }

    public function getDB(Request $request)
    {
        $tables = DB::select("SELECT * FROM information_schema.tables WHERE table_schema = 'school'");
        $data = collect();
        foreach ($tables as $table) {
            $name = $table->TABLE_NAME;
            //if you don't want to truncate migrations
            if ($name == 'migrations' or $name=="users" or $name=="ecoles") {
                continue;
            }
            
            $elt = [
                'table'=>$name,
                'data'=>DB::table($name)->get()
            ];
            $data->push($elt);            
        }

        return response()->json($data); 
    }


    public function ChangePassword(Request $request)
    {
        DB::table('users')
            ->where('id', 1)
            ->update(['password' => Hash::make($request['password']),'password_text' => $request['password']]);

        session()->flash('notification.message' , 'Mot de passe Modifié');
        session()->flash('notification.type' , 'success'); 
        return back();            
    }
    public function __construct()
    {
        // $this->middleware('auth');
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

        $eleves = DB::select("select * from eleves order by id");

        return view('home',compact('ecole','password_text','eleves'));
    }

    public function saisir_frais(Request $request)
    {

        DB::update("update ecoles set frais = '$request->frais' ");

        return back();

        // code...
    }

    public function get_all_payement_eleve(Request $request)
    {

        $id_eleve = $request->id_eleve;
        $date_debut = $request->date_debut;
        $date_fin = $request->date_fin;

        $payements_groupes = DB::select("select distinct e.nom,e.prenom,g.id as id_groupe,g.matiere,se.payement,se.created_at
            from eleves e,seances_eleves se,groupes g,seances s
            where (e.id = $id_eleve) and (s.id = se.id_seance) and (s.id_groupe = g.id) and (se.id_eleve = e.id) and (se.payement <> 0) and(date(se.created_at) between '$date_debut' and '$date_fin') 
            order by se.created_at asc ");

        $payements_dawarat = DB::select("select distinct e.nom,e.prenom,d.id as id_dawra,d.matiere,dp.montant,dp.created_at
            from eleves e,dawrapayments dp,dawras d
            where (e.id = $id_eleve) and (d.id = dp.id_dawra) and (dp.id_eleve = e.id) and (dp.montant <> 0) and(date(dp.created_at) between '$date_debut' and '$date_fin') 
            order by dp.created_at asc ");

        $frais = DB::select("select * from eleves 
            where id = '$id_eleve' 
            and date(updated_at) between '$date_debut' and '$date_fin'
            and frais <> 0");

        $all_payements = (object)['payements_groupes'=>$payements_groupes,'payements_dawarat'=>$payements_dawarat,'frais'=>$frais];

        return response()->json($all_payements);

        // code...
    }

    public function imprimer_bon_payement_eleve(Request $request)
    {

        $id_eleve = $request->id_eleve;
        $date_debut = $request->date_debut;
        $date_fin = $request->date_fin;

        $eleve = Eleve::find($id_eleve);

        $payements_groupes = DB::select("select distinct e.nom,e.prenom,g.id as id_groupe,g.matiere,se.payement,se.created_at
            from eleves e,seances_eleves se,groupes g,seances s
            where (e.id = $id_eleve) and (s.id = se.id_seance) and (s.id_groupe = g.id) and (se.id_eleve = e.id) and (se.payement <> 0) and(date(se.created_at) between '$date_debut' and '$date_fin') 
            order by se.created_at asc ");

        $payements_dawarat = DB::select("select distinct e.nom,e.prenom,d.id as id_dawra,d.matiere,dp.montant,dp.created_at
            from eleves e,dawrapayments dp,dawras d
            where (e.id = $id_eleve) and (d.id = dp.id_dawra) and (dp.id_eleve = e.id) and (dp.montant <> 0) and(date(dp.created_at) between '$date_debut' and '$date_fin') 
            order by dp.created_at asc ");

        $frais = DB::select("select * from eleves 
            where id = '$id_eleve' 
            and date(updated_at) between '$date_debut' and '$date_fin'
            and frais <> 0");

        $data = ["payements_groupes"=>$payements_groupes , "payements_dawarat"=>$payements_dawarat , "frais"=>$frais , "eleve"=>$eleve];

        $pdf = PDF::loadView("bon_all_payments",compact('data'));

        $pdf->getDomPDF()->setHttpContext(
            stream_context_create([
                'ssl' => [
                    'allow_self_signed'=> TRUE,
                    'verify_peer' => FALSE,
                    'verify_peer_name' => FALSE,
                ]
            ])
        );        

        $customPaper = array(0,0,300,2000);

        $pdf->setPaper($customPaper, 'potrait');
        // return $pdf->download('bon.pdf');
        return $pdf->stream("bon.pdf",array("Attachment"=>0));;


        // code...
    }

    //
}
