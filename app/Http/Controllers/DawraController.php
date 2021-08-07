<?php

namespace App\Http\Controllers;

use App\Groupe;
use App\Eleve;
use App\Dawra;
use App\Dawraeleve;
use App\Seancesdawra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;


class DawraController extends Controller
{

    public function dawrat()
    {

        $annee_scolaire=(Groupe::get_annee_scolaire());
        $dawrates=Dawra::all();
        $annee_scolaire=(Groupe::get_annee_scolaire());
        $salles=DB::select("select * from classes where visible =1 order by num");
        $niveaux=DB::select("select * from niveaux where visible = 1");
        $matieres=DB::select("select * from matieres /*where visible =1*/");
        $profs=DB::select("select * from profs where visible = 1");


        return view('Home.dawrates',compact('dawrates',
            'annee_scolaire',
            'salles',
            'niveaux',
            'matieres',
            'profs'
        ));

        # code...
    }

    public function fit_salles(Request $request)
    {

        $annee_scolaire=(Groupe::get_annee_scolaire());

        $dispo=(DB::select("select * from groupes where jour = \"$request->jour\" and classe=\"$request->salle\" and visible = 1 and annee_scolaire = \"$annee_scolaire\""));

        $debut = strtotime($request->debut);
        $fin = strtotime($request->fin);

        foreach ($dispo as $disp) 
        {

            $time_debut = strtotime($disp->heure_debut);
            $time_fin = strtotime($disp->heure_fin);


            if(($debut>=$time_debut && $fin<=$time_fin)||
            ($time_debut<=$debut && $time_fin>=$fin)||
            ($debut>=$time_debut && $debut<$time_fin && $fin>=$time_fin)||
            ($debut<=$time_debut && $fin<=$time_fin && $fin>$time_debut)) 

            {
             
                return response()->json($disp);

                // code...
            }

            // code...
        }
        
        return response()->json(true);
        // code...
    }

    public function modifier(Request $request)
    {

    	DB::update("update groupes set tel = \"$request->tel\" where id = \"$request->id\" ");

    	# code...
    }

    public function supprimer(Request $request)
    {

    	DB::update("update groupes set visible = 0 where id = \"$request->id\" ");

    	# code...
    }

    public function ajouter(Request $request)
    {   
        $dawra = new Dawra();
        $dawra->prof = $request['prof'];
        $dawra->niveau = $request['niveau'];
        $dawra->matiere = $request['matiere'];
        $dawra->nbrseances = $request['nbrseances'];
        $dawra->pourcentage_prof = $request['pourcentage_prof'];
        $dawra->pourcentage_ecole = $request['pourcentage_ecole'];
        $dawra->tarif = $request['tarif'];
        $dawra->save();
       
       session()->flash('notification.message' , 'Dawra : '.$request->matiere.' , '.$request->niveau.' Prof : '.$request->prof.' ajoutée avec succés');

       session()->flash('notification.type' , 'success'); 

       return back();

    	# code...
    }

    public function get_profs(Request $request)
    {
      
        $profs1=DB::select("select * from profs where (matiere = \"$request->matiere\" and cycle=\"$request->cycle\") and visible = 1 ");

        $profs2=DB::select("select * from profs where (matiere <> \"$request->matiere\" or cycle <> \"$request->cycle\") and visible = 1 ");
        
        $tous=array_merge($profs1,$profs2);

        return response()->json($tous);
    }

    public function afficher_dawra($id)
    {
        $dawra = Dawra::find($id);
        $eleves = Dawraeleve::where('id_dawra',$id)->pluck("id_eleve")->toArray();
        $eleves = Eleve::whereIn('id',$eleves)->get();
        return view('Home.single_dawra',compact('dawra','eleves'));
        //,'eleves_groupe','seances_eleves','numero_de_la_seance_dans_le_mois','id','payments','ancien_payments','le_mois','nb_presences','numtel'));
        // code...
    }

    public function ajouter_eleve($id,Request $request)
    {
        $eleve = Eleve::where(
            [
                'nom'=>$request['nom'],
                'prenom'=>$request['prenom'],
                'num_tel'=>$request['num_tel'],                                
            ]
        )->first();
        if($eleve){
            // eleve qui existe
            $eleveInDawra = $eleve->isInDawra($id);
            if($eleveInDawra){
                // eleve deja assigné au dawra
                session()->flash('notification.message' , 'Elève :  Déja Ajouté ');
                session()->flash('notification.type' , 'success'); 
                return back();
        
            }else{
                dump('find');
                //eleve qui existe mais il n'a pas été assigné , donc faudrai l'assigner
                $dawra = Dawra::find($id);
                $nbrseances = $dawra->nbrseances;
                $dawraeleve = new Dawraeleve();
                $dawraeleve->id_eleve = $id_eleve;
                $dawraeleve->id_dawra = $dawra->id;
                $dawraeleve->save();
                for($i=0;$i<$nbrseances;$i++) {
                    $seanceDawra = new Seancesdawra();
                    $seanceDawra->id_eleve = $eleve->id;
                    $seanceDawra->id_dawra = $dawra->id;
                    $seanceDawra->num_seance = $i;
                    $seanceDawra->presence = 0;
                    $seanceDawra->save();
                }
            }
        }else{
            //elve qui n'existe pas
            DB::insert("insert into eleves(nom,prenom,num_tel) values(\"$request->nom\",\"$request->prenom\",\"$request->num_tel\") ");
            $last = DB::select("select * from eleves order by id desc");
            $id_eleve = $last[0]->id;    
            $dawra = Dawra::find($id);
            $tarif= $dawra->tarif;
            $nbrseances = $dawra->nbrseances;
            $dawraeleve = new Dawraeleve();
            $dawraeleve->id_eleve = $id_eleve;
            $dawraeleve->id_dawra = $dawra->id;
            $dawraeleve->payment = $request['payment'];
            if($tarif==$request['payment']){
                $dawraeleve->paye = 1;
            }else{
                $dawraeleve->paye = 0;
            }
            $dawraeleve->reste = $tarif-$request['payment'];            
            $dawraeleve->save();
            for($i=0;$i<$nbrseances;$i++) {
                $seanceDawra = new Seancesdawra();
                $seanceDawra->id_eleve = $id_eleve;
                $seanceDawra->id_dawra = $dawra->id;
                $seanceDawra->num_seance = $i;
                $seanceDawra->presence = 0;
                $seanceDawra->save();
            }
            session()->flash('notification.message' , 'Elève : '.$last[0]->nom.' , '.$last[0]->prenom.' ajoutée avec succés');
            session()->flash('notification.type' , 'success'); 
            return back();
    
        }
    
        
    }

    public function valider_coches(Request $request)
    {
        $data = json_decode($request['data']);
        $dawra = $request['dawra'];
        foreach($data as $d){
            $eleve = Eleve::find($d->eleve);
            DB::table('seancesdawras')
                        ->where(['id_eleve'=>$d->eleve,'num_seance'=>$d->num_seance,'id_dawra'=>$dawra])
                        ->update(['presence' => 1]);
            /**
             * updae current seance
             */
            DB::table('dawras')
                        ->where(['id'=>$dawra])
                        ->increment('current_seance',1);

        }
    }


    //



    //
}
