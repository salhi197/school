<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dawra extends Model
{
    public function getNbreleve()
    {
        return Dawraeleve::where('id_dawra',$this->id)->get()->count();
    }
}
