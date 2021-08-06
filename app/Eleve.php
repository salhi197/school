<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eleve extends Model
{
    //use HasFactory;
    protected $fillable = [
        'nom',
        'prenom',
        'num_tel'        
    ];

    public function isInDawra($dawra)
    {
        return Dawraeleve::where(['id_dawra'=>$dawra,'id_eleve'=>$this->id])->first() === null;
    }


    public function getEleveDawraPayment($dawra)
    {
        $payment = Dawraeleve::where(['id_dawra'=>$dawra,'id_eleve'=>$this->id])->first()['payment'];
        return $payment;
    }

    public function getEleveDawraReste($dawra)
    {
        $reste = Dawraeleve::where(['id_dawra'=>$dawra,'id_eleve'=>$this->id])->first()['reste'];
        return $reste;
    }


    public function getDawraSeances($dawra)
    {
        $seances = Seancesdawra::where(['id_dawra'=>$dawra,'id_eleve'=>$this->id])->get();
        return $seances;
    }
}
