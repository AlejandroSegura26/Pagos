<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagoColegiatura extends Model
{
      protected $table = 'pagosColegiaturas';
    protected $filltable =[ 
    'id',
    'colegiatura_id',
    'alumno_id',
    'estado'];
    public $timestamps = false;


    public function Hito(){
        return $this -> hasMany('App\PagoColegiatura');
    }
}
