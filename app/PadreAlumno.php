<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PadreAlumno extends Model
{
  
      protected $table = 'padresAlumnos';
    protected $filltable =[ 
    'id',
    'padre_id',
    'alumno_id'];
    public $timestamps = false;


    public function PadreAlumno(){
        return $this -> hasMany('App\PadreAlumno');
    }
}
