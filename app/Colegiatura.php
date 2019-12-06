<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Colegiatura extends Model
{
      protected $table = 'colegiaturas';
    protected $filltable =[ 
    'id',
    'perido',
    'monto',
    'estado'];
    public $timestamps = false;


    public function Hito(){
        return $this -> hasMany('App\Alumno');
    }
}
