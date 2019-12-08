@extends('principal')
@section('contenido')
 
        <template v-if="menu==0">
            <h1>¡Bienvenido!</h1>
        </template>

           <template v-if="menu==1">
           <padres></padres>
        </template>
        <template v-if="menu==2">
           <alum></alum>
        </template>

       <template v-if="menu==3">
           <grupos></grupos>
        </template>
          <template v-if="menu==4">
           <colegiaturas></colegiaturas>
        </template>
        <!-- Tareas -->
        <template v-if="menu==5">
            <pagoscolegiaturas></pagoscolegiaturas>
        </template>
        <!-- Boletos -->
        <template v-if="menu==6">
            <compras></compras>
        </template>
      <template v-if="menu==7">
           <rentas></rentas>
        </template>
        <!-- Métodos de Pago -->
        <template v-if="menu==8">
             <servicios></servicios>
        </template>
        <!-- Proyectos -->
        <template v-if="menu==9">
        <estadocuenta></estadocuenta>
        </template>
 
@endsection
