<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Validation\Rules\Unique;

class UsuariosTable extends Migration
{
   
    public function up()
    {
       Schema::create('usuarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre')->unique();
            $table->string('correo_electronico',75);
            $table->string('usuario')->unique();
            $table->string('password');
            $table->boolean('condicion')->default(1);
            $table->unsignedBigInteger('rol_id');
        
            $table->rememberToken();
        });
        DB::insert('insert into usuarios (id, nombre, correo_electronico, usuario, password, rol_id) values (?, ?, ?, ?, ?, ?)', [1, 'Administrador','admin@gmail.com','admin','$2y$12$LKYABBuAmrDJTQikaS64/exiKI3eueRdJddGH76zQ3zKMn27n.4wq','1']);
         }
        
        public function down()
        {
            Schema::dropIfExists('usuarios');
        }
}
