<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
   
    protected $table = 'grupos';
    protected $filltable =[ 
    'id',
    'nombre',
    'descripcion'];
    public $timestamps = false;


    public function Grupo(){
        return $this -> hasMany('App\Grupo');
    }
}
