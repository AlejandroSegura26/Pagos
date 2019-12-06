<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cartera extends Model
{
   protected $table = 'cartera';
    protected $filltable =[ 
    'id',
    'saldo'];
    public $timestamps = false;


    public function Hito(){
        return $this -> hasMany('App\Cartera');
    }
}
