<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MovimientosTable extends Migration
{
    
    public function up()
    {
       Schema::create('movimientos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tipoMovimiento',100);
            $table->string('asunto',20);
            $table->string('originario',100);
            $table->decimal('monto');
        });
        
          }
       
        public function down()
        {
            Schema::dropIfExists('movimientos');
        }
}
