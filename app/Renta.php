<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Renta extends Model
{
    protected $table = 'rentas';
    protected $filltable =[ 
      'id',
      'nombre',
      'telefono',
      'encargado',
      'estado'];
    public $timestamps = false;
}
