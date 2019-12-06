<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Compra;
use App\Cartera;
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
                   'total' => $compra->total(),
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
          $compra -> estado = 1;
          $compra -> save();
        
          return 1;
        }
        else
        {
          return 0;
        }
        
        
      }
  
   public function desactivar(Request $request)
     {
        if (!$request->ajax()) return redirect('/'); 
         $colegiatura = Colegiatura :: findOrFail($request->id);
         $colegiatura -> estado = 0;
         $colegiatura -> save();
        
      }
      
}
