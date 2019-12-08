<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PagoColegiatura;
use App\Alumno;
use App\Movimiento;
use App\Cartera;
use App\PadreAlumno;
class PagoColegiaturaController extends Controller
{
      public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio; 
        if ($buscar == '') 
        {
             $colegiatura =PagoColegiatura::join('alumnos','alumnos.id','=','pagosColegiaturas.alumno_id')
               ->join('colegiaturas','colegiaturas.id','=','pagosColegiaturas.colegiatura_id')
          ->select('pagosColegiaturas.id','colegiaturas.periodo','alumnos.nombre','colegiaturas.monto','pagosColegiaturas.estado')
              ->orderBy('pagosColegiaturas.id','desc')
            ->paginate(5);
        }
        else 
        {
         $colegiatura =PagoColegiatura::join('alumnos','alumnos.id','=','pagosColegiaturas.alumno_id')
               ->join('colegiaturas','colegiaturas.id','=','pagosColegiaturas.colegiatura_id')
          ->select('pagosColegiaturas.id','colegiaturas.periodo','alumnos.nombre','colegiaturas.monto','pagosColegiaturas.estado')
           ->where('colegiaturas.'.$criterio,'like','%'.$buscar.'%')
             ->orderBy('colegiaturas.id','desc')
            ->paginate(5); 
        }
 
           return [
               'pagination' => [
                   'total' => $colegiatura->total(),
                   'current_page' => $colegiatura->currentPage(),
                   'per_page' => $colegiatura->perPage(),
                   'last_page' => $colegiatura->lastPage(),
                   'from' => $colegiatura->firstItem(),
                   'to' => $colegiatura->lastItem(),
               ],
               'colegiatura' => $colegiatura
           ];
       }
  
  
  public function pagar(Request $request)
  {
       if (!$request->ajax()) return redirect('/');
        $colegiatura = PagoColegiatura :: findOrFail($request->id);
        $colegiatura->estado=1;
        $colegiatura -> save();
        $movimientos = new Movimiento();
        $movimientos -> tipoMovimiento =  "Deposito";
        $movimientos -> asunto =  "Colegiatura";
        $movimientos -> originario = $request -> nombre;
        $movimientos -> monto = $request -> monto;
        $movimientos -> save();
        $cartera = Cartera :: findOrFail('1');
        $cartera->saldo=$cartera->saldo+$request->monto;
        $cartera->save();
        $ap = PadreAlumno::all();
        $idPadre=1;
        $idHermano=0;
		    foreach ($ap as $v) 
				 if($v->alumno_id==$request->id)
           $idPadre=$v->padre_id;
			 foreach ($ap as $v) 
				 if($v->padre_id==$idPadre&&$v->alumno_id!=$request->id)
           $idHermano=$v->alumno_id;
      $pc = PagoColegiatura::all();
      $idcHermano=0;
      foreach ($pc as $v) 
				 if($v->alumno_id==$idHermano)
           $idcHermano=$v->id;
      $colegiatura = PagoColegiatura :: findOrFail($idcHermano);
        $colegiatura->estado=1;
        $colegiatura -> save();
      return $idHermano;
  }
}
