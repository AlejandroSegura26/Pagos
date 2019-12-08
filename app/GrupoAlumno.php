<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GrupoAlumno extends Model
{
   protected $table = 'gruposAlumnos';
    protected $filltable =[ 
    'id',
    'grupo_id',
    'alumno_id',];
    public $timestamps = false;


    public function GrupoAlumno(){
        return $this -> hasMany('App\GrupoAlumno');
    }
}
