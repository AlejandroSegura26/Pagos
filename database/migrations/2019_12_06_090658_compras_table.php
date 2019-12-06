<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ComprasTable extends Migration
{
       
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('asunto',100);
            $table->string('monto');
            $table->boolean('estado')->default(1);
        });
    }
 
    public function down()
    {
        Schema::dropIfExists('compras');
    }
}
