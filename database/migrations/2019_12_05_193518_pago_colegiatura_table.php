<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PagoColegiaturaTable extends Migration
{
   public function up()
    {
          Schema::create('pagosColegiaturas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('colegiatura_id');
            $table->foreign('colegiatura_id')->references('id')->on('colegiaturas')->onDelete('cascade');
            $table->unsignedBigInteger('alumno_id');
            $table->foreign('alumno_id')->references('id')->on('alumnos')->onDelete('cascade');
            $table->boolean('estado')->default(1);
              });
    }

 
    public function down()
    {
           Schema::dropIfExists('pagoColegiaturas');
    }
}
