@extends('principal')
@section('contenido')
 
        <template v-if="menu==0">
            <h1>¡Bienvenido!</h1>
        </template>
        <!-- Hitos -->
        <template v-if="menu==1">
           <alum></alum>
        </template>
          <template v-if="menu==2">
           <colegiaturas></colegiaturas>
        </template>
        <!-- Tareas -->
        <template v-if="menu==3">
            <pagoscolegiaturas></pagoscolegiaturas>
        </template>
        <!-- Boletos -->
        <template v-if="menu==4">
           <h1>Administrador / 8</h1>
        </template>
        <!-- Problemas -->
        <template v-if="menu==5">
          <h1>Administrador / 8</h1>
        </template>
        <!-- Métodos de Pago -->
        <template v-if="menu==6">
             <servicios></servicios>
        </template>
        <!-- Proyectos -->
        <template v-if="menu==7">
        <estadocuenta></estadocuenta>
        </template>
 
@endsection
