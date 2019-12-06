<?php

namespace App;
	 	 	 	 	 
use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    protected $table = 'movimientos';
    protected $filltable =[ 
    'tipoMovimiento',
    'asunto',
    'originario',
    'monto',
     ];
    public $timestamps = false;


    public function Hito(){
        return $this -> hasMany('App\Movimiento');
    }
}
