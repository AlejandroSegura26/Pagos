<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provedor extends Model
{
     protected $table = 'provedores';
    protected $filltable =[ 
    'id',
    'nombre',
    'telefono',
    'direccion',
    'estado'];
    public $timestamps = false;


    public function Hito(){
        return $this -> hasMany('App\Provedor');
    }
}
