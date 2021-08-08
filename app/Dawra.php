<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dawra extends Model
{
    public function getNbreleve()
    {
        return Dawraeleve::where('id_dawra',$this->id)->get()->count();
    }

    public function getEleves()
    {
        $eleves = Dawraeleve::where('id_dawra',$this->id)->pluck("id_eleve")->toArray();
        $eleves = Eleve::whereIn('id',$eleves)->get();
        return $eleves;

    }
    
}
