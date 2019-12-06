<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Provedor;
use App\Movimiento;
use App\Cartera;
class ProvedorController extends Controller
{
     public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio; 
        if ($buscar == '') 
        {
             $provedor =Provedor:: 
          select('*')
              ->orderBy('provedores.id','desc')
            ->paginate(5);
        }
        else 
        {
            $provedor = Provedor::where('provedores.'.$criterio,'like','%'.$buscar.'%')
             ->orderBy('provedores.id','desc')
            ->paginate(5);
        }

           return [
               'pagination' => [
                   'total' => $provedor->total(),
                   'current_page' => $provedor->currentPage(),
                   'per_page' => $provedor->perPage(),
                   'last_page' => $provedor->lastPage(),
                   'from' => $provedor->firstItem(),
                   'to' => $provedor->lastItem(),
               ],
               'provedor' => $provedor
           ];
       }
  
     public function store(Request $request)
     {
        if (!$request->ajax()) return redirect('/'); 
         $provedor = new Provedor();
         $provedor -> nombre = $request -> nombre;
         $provedor -> telefono = $request -> telefono;
         $provedor -> direccion = $request -> direccion;
         $provedor -> estado = 1;
         $provedor -> save();
        
      }
      
    public function update(Request $request)
     {
        if (!$request->ajax()) return redirect('/'); 
         $provedor = Provedor :: findOrFail($request->id);
         $provedor -> nombre = $request -> nombre;
         $provedor -> telefono = $request -> telefono;
         $provedor -> direccion = $request -> direccion;
         $provedor -> save();
        
      }
    
    public function desactivar(Request $request)
     {
        if (!$request->ajax()) return redirect('/'); 
         $provedor = Provedor :: findOrFail($request->id);
         $provedor -> estado = 0;
         $provedor -> save();
        
      }
    
     public function activar(Request $request)
     {
        if (!$request->ajax()) return redirect('/'); 
         if (!$request->ajax()) return redirect('/'); 
         $provedor = Provedor :: findOrFail($request->id);
         $provedor -> estado = 1;
         $provedor -> save();
        
      }
  
    
  public function pagar(Request $request)
  {
       if (!$request->ajax()) return redirect('/');
        $cartera = Cartera :: findOrFail('1');
        if($request->monto<$cartera->saldo)
        {
          $movimientos = new Movimiento();
          $movimientos -> tipoMovimiento =  "Salida";
          $movimientos -> asunto =  "Retiro";
          $movimientos -> originario = $request -> nombre;
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
