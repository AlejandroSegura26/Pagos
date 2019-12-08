<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GrupoAlumnoTable extends Migration
{
      
    public function up()
    {
          Schema::create('gruposAlumnos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('grupo_id');
            $table->foreign('grupo_id')->references('id')->on('grupos')->onDelete('cascade');
            $table->unsignedBigInteger('alumno_id');
            $table->foreign('alumno_id')->references('id')->on('alumnos')->onDelete('cascade');
            
              });
    }

 
    public function down()
    {
           Schema::dropIfExists('gruposAlumnos');
    }
}

