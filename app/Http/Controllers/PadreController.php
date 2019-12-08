<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Padre;
use App\PadreAlumno;
class PadreController extends Controller
{
   public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio; 
        if ($buscar == '') 
        {
             $padre =Padre:: 
          select('*')
              ->orderBy('padres.id','desc')
            ->paginate(5);
        }
        else 
        {
            $padre = Padre::where('padres.'.$criterio,'like','%'.$buscar.'%')
             ->orderBy('padres.id','desc')
            ->paginate(5);
        }

           return [
               'pagination' => [
                   'total' => $padre->total(),
                   'current_page' => $padre->currentPage(),
                   'per_page' => $padre->perPage(),
                   'last_page' => $padre->lastPage(),
                   'from' => $padre->firstItem(),
                   'to' => $padre->lastItem(),
               ],
               'padre' => $padre
           ];
       }
  
  
     public function store(Request $request)
     {
        if (!$request->ajax()) return redirect('/'); 
         $padre = new Padre();
         $padre -> nombre = $request -> nombre;
         $padre -> telefono = $request -> telefono;
         $padre -> estado = 1;
         $padre -> save();
        
      }
  
     public function update(Request $request)
     {
        if (!$request->ajax()) return redirect('/'); 
         $padre = Padre :: findOrFail($request->id);
         $padre -> nombre = $request -> nombre;
         $padre -> telefono = $request -> telefono;
         $padre -> save();
      }
  
      public function desactivar(Request $request)
     {
        if (!$request->ajax()) return redirect('/'); 
          $padreAlumno =PadreAlumno::join('alumnos','alumnos.id','=','padresAlumnos.alumno_id')
        ->select('padresAlumnos.id')
            ->where('padresAlumnos.padre_id','=',$request->id)
             ->where('alumnos.estado','=',1)
            ->count();
      if($padreAlumno>0)
        return 0;
      else
      {
        $padre = Padre :: findOrFail($request->id);
         $padre -> estado = 0;
         $padre -> save();
        return 1;
       } 
      }
  
       public function selectPadre(Request $request)
        {
            $padre = Padre::select('padres.id','padres.nombre')
                  ->where('padres.estado','=',1)
                   ->orderBy('padres.nombre','asc')->get();
        
            return ['padre' => $padre];
        }
    
    
}
