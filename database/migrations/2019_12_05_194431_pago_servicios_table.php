<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PagoServiciosTable extends Migration
{
    public function up()
    {
          Schema::create('pagosServicios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('provedor_id');
            $table->foreign('provedor_id')->references('id')->on('provedores')->onDelete('cascade');
           
              });
    }

 
    public function down()
    {
           Schema::dropIfExists('pagosServicios');
    }
}
