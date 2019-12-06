<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CarteraTable extends Migration
{
      public function up()
    {
       Schema::create('cartera', function (Blueprint $table) {
            $table->tinyInteger('id');
            $table->decimal('saldo');
        });
          DB::insert('insert into cartera (id, saldo) values (?,?)', [1, 0]);
      
          }
        
        public function down()
        {
            Schema::dropIfExists('cartera');
        }
}
