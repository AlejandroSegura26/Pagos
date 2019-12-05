<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlumnosTable extends Migration
{
    
    public function up()
    {
       Schema::create('alumnos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre',100);
            $table->string('correo_electronico',75);
            $table->string('telefono',10);
            $table->datetime('fecha_nacimiento');
            $table->boolean('estado')->default(1);
        });
          }
        
        public function down()
        {
            Schema::dropIfExists('alumnos');
        }
}
