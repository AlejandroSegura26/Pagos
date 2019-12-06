<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Compra;
use App\Cartera;
use App\Movimiento;
class CompraController extends Controller
{
   public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio; 
        if ($buscar == '') 
        {
             $compra =Compra:: 
          select('*')
              ->orderBy('compras.id','desc')
            ->paginate(5);
        }
        else 
        {
            $compra = Compra::where('compras.'.$criterio,'like','%'.$buscar.'%')
             ->orderBy('compras.id','desc')
            ->paginate(5);
        }

           return [
               'pagination' => [
                   '239000.00total' => $compra->total(),
                   'current_page' => $compra->currentPage(),
                   'per_page' => $compra->perPage(),
                   'last_page' => $compra->lastPage(),
                   'from' => $compra->firstItem(),
                   'to' => $compra->lastItem(),
               ],
               'compra' => $compra
           ];
       }
  
     public function store(Request $request)
     {
       if (!$request->ajax()) return redirect('/');
        $cartera = Cartera :: findOrFail('1');
        if($request->monto<$cartera->saldo)
        {
          $compra = new Compra();
          $compra -> asunto = $request -> asunto;
          $compra -> monto = $request -> monto;
          $compra -> save();
          $movimientos = new Movimiento();
          $movimientos -> tipoMovimiento =  "Salida";
          $movimientos -> asunto =  "Compra";
          $movimientos -> originario = $request -> asunto;
          $movimientos -> monto = $request -> monto;
          $movimientos -> save();
          $cartera->saldo=$cartera->saldo-$request->monto;
          $cartera->save();
          return 1;
        }
        else
        {
          return 0;
        }
        
        
      }
  
   
      
}
