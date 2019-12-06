<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Colegiatura;
class ColegiaturaController extends Controller
{
     public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio; 
        if ($buscar == '') 
        {
             $colegiatura =Colegiatura:: 
          select('*')
              ->orderBy('colegiaturas.id','desc')
            ->paginate(5);
        }
        else 
        {
            $colegiatura = Colegiatura::where('colegiaturas.'.$criterio,'like','%'.$buscar.'%')
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
  
     public function store(Request $request)
     {
        if (!$request->ajax()) return redirect('/'); 
         $colegiatura = new Colegiatura();
         $colegiatura -> periodo = $request -> periodo;
         $colegiatura -> monto = $request -> monto;
         $colegiatura -> estado = 1;
         $colegiatura -> save();
        
      }
      
    public function update(Request $request)
     {
        if (!$request->ajax()) return redirect('/'); 
         $colegiatura = Colegiatura :: findOrFail($request->id);
          $colegiatura -> periodo = $request -> periodo;
         $colegiatura -> monto = $request -> monto;
         $colegiatura -> save();
        
      }
    
    public function desactivar(Request $request)
     {
        if (!$request->ajax()) return redirect('/'); 
         $colegiatura = Colegiatura :: findOrFail($request->id);
         $colegiatura -> estado = 0;
         $colegiatura -> save();
        
      }
    
     public function activar(Request $request)
     {
        if (!$request->ajax()) return redirect('/'); 
         if (!$request->ajax()) return redirect('/'); 
        $colegiatura = Colegiatura :: findOrFail($request->id);
         $colegiatura -> estado = 1;
         $colegiatura -> save();
        
      }
}
