<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ColegiaturaTable extends Migration
{
    
    public function up()
    {
          Schema::create('colegiaturas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('periodo',100);
            $table->decimal('monto');
            $table->boolean('estado')->default(1);
              });
    }

 
    public function down()
    {
           Schema::dropIfExists('colegiatura');
    }
}
