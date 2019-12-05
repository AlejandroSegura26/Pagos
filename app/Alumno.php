<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $table = 'alumnos';
    protected $filltable =[ 
    'id',
    'nombre',
    'correo_electronico',
    'telefono',
    'fecha_nacimiento',
    'estado'];
    public $timestamps = false;


    public function Hito(){
        return $this -> hasMany('App\Alumno');
    }
}
