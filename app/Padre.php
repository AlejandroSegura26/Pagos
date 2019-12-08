<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Padre extends Model
{
     protected $table = 'padres';
    protected $filltable =[ 
    'id',
    'nombre',
    'telefono',
    'estado' ];
     public $timestamps = false;
 
    public function Padre(){
        return $this -> hasMany('App\Padre');
    }
}
