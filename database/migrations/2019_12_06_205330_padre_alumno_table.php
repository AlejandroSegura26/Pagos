<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PadreAlumnoTable extends Migration
{
   
    public function up()
    {
          Schema::create('padresAlumnos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('padre_id');
            $table->foreign('padre_id')->references('id')->on('padres')->onDelete('cascade');
            $table->unsignedBigInteger('alumno_id');
            $table->foreign('alumno_id')->references('id')->on('alumnos')->onDelete('cascade');
 
              });
    }

 
    public function down()
    {
           Schema::dropIfExists('padresAlumnos');
    }
}
