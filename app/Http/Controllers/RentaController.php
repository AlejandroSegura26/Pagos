<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Renta;
use App\Cartera;
use App\Movimiento;

class RentaController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio; 
        if ($buscar == '') 
        {
             $renta =Renta:: 
          select('*')
              ->orderBy('rentas.id','desc')
            ->paginate(5);
        }
        else 
        {
            $renta = Renta::where('rentas.'.$criterio,'like','%'.$buscar.'%')
             ->orderBy('rentas.id','desc')
            ->paginate(5);
        }

           return [
               'pagination' => [
                   'total' => $renta->total(),
                   'current_page' => $renta->currentPage(),
                   'per_page' => $renta->perPage(),
                   'last_page' => $renta->lastPage(),
                   'from' => $renta->firstItem(),
                   'to' => $renta->lastItem(),
               ],
               'renta' => $renta
           ];
       }
  
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/'); 
         $renta = new Renta();
         $renta -> nombre = $request -> nombre;
         $renta -> telefono = $request -> telefono;
         $renta -> encargado = $request -> encargado;
         $renta -> estado = 1;
         $renta -> save();
        
      }
  
    public function update(Request $request)
     {
        if (!$request->ajax()) return redirect('/'); 
          $renta = Renta :: findOrFail($request->id);
         $renta -> nombre = $request -> nombre;
         $renta -> telefono = $request -> telefono;
         $renta -> encargado = $request -> encargado;
          
         $renta -> save();
        
      }
  
    public function desactivar(Request $request)
      {
        $renta = Renta :: findOrFail($request->id);
         $renta -> estado = 0;
         $renta -> save();
        return 1;
       }
  public function activar(Request $request)
      {
        $renta = Renta :: findOrFail($request->id);
         $renta -> estado = 1;
         $renta -> save();
        return 1;
       }
  
 public function pagar(Request $request)
  {
       if (!$request->ajax()) return redirect('/');
        $movimientos = new Movimiento();
        $movimientos -> tipoMovimiento =  "Entrada";
        $movimientos -> asunto =  "Renta";
        $movimientos -> originario = $request -> nombre;
        $movimientos -> monto = $request -> monto;
        $movimientos -> save();
        $cartera = Cartera :: findOrFail('1');
        $cartera->saldo=$cartera->saldo+$request->monto;
        $cartera->save();
  }
}
