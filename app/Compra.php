<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
   protected $table = 'compras';
    protected $filltable =[ 
    'id',
    'asunto',
    'monto',];
    public $timestamps = false;


    public function Compra(){
        return $this -> hasMany('App\Compra');
    }
}
