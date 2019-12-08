<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PadresTable extends Migration
{
     public function up()
    {
        Schema::create('padres', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre',100);
            $table->string('telefono',10);
             $table->boolean('estado')->default(1);
        });
    }
 
    public function down()
    {
        Schema::dropIfExists('padres');
    }
}
