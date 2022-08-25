<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PDF;


use App\Eleve;

use App\Groupe;


class ParticulierController extends Controller
{

    public function bon(Request $request)
    {   

        $data = $request->all();

        $id_eleve = $request->id_eleve ?? $id_eleve;

        $eleve = Eleve::find($id_eleve);

        $id_groupe = $request->id_groupe ?? $id_groupe;

        $mois = $request->mois ?? Groupe::get_the_month($id_groupe);

        $montant = $request->montant ?? $montant;
        
        $data = ["montant"=>$montant , "mois"=>$mois , "id_eleve"=>$id_eleve , "id_groupe"=>$id_groupe];

        $pdf = PDF::loadView("bon",compact('data'));

        

        //$pdf = $pdf->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

       
        $pdf->getDomPDF()->setHttpContext(
            stream_context_create([
                'ssl' => [
                    'allow_self_signed'=> TRUE,
                    'verify_peer' => FALSE,
                    'verify_peer_name' => FALSE,
                ]
            ])
        );        
        $pdf->setPaper('A6', 'potrait');
        return $pdf->download('bon.pdf');
        return $pdf->stream("bon.pdf",array("Attachment"=>0));;
        
        // code...
    }

    //
}
