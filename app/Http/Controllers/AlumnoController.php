<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alumno;
use App\PagoColegiatura;
class AlumnoController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio; 
        if ($buscar == '') 
        {
             $alumno =Alumno:: 
          select('*')
              ->orderBy('alumnos.id','desc')
            ->paginate(5);
        }
        else 
        {
            $alumno = Alumno::where('alumnos.'.$criterio,'like','%'.$buscar.'%')
             ->orderBy('alumnos.id','desc')
            ->paginate(5);
        }

           return [
               'pagination' => [
                   'total' => $alumno->total(),
                   'current_page' => $alumno->currentPage(),
                   'per_page' => $alumno->perPage(),
                   'last_page' => $alumno->lastPage(),
                   'from' => $alumno->firstItem(),
                   'to' => $alumno->lastItem(),
               ],
               'alumno' => $alumno
           ];
       }
  
     public function store(Request $request)
     {
        if (!$request->ajax()) return redirect('/'); 
         $alumno = new Alumno();
         $alumno -> nombre = $request -> nombre;
         $alumno -> correo_electronico = $request -> correo;
         $alumno -> telefono = $request -> telefono;
         $alumno -> fecha_nacimiento = $request -> fecha;
         $alumno -> estado = 1;
         $alumno -> save();
        
      }
      
    public function update(Request $request)
     {
        if (!$request->ajax()) return redirect('/'); 
          $alumno = Alumno :: findOrFail($request->id);
         $alumno -> nombre = $request -> nombre;
         $alumno -> correo_electronico = $request -> correo;
         $alumno -> telefono = $request -> telefono;
         $alumno -> fecha_nacimiento = $request -> fecha;
          
         $alumno -> save();
        
      }
    
    public function desactivar(Request $request)
     {
        if (!$request->ajax()) return redirect('/'); 
          $colegiatura =PagoColegiatura::select('pagosColegiaturas.id')
            ->where('pagosColegiaturas.alumno_id','=',$request->id)
            ->where('pagosColegiaturas.estado','=',0)->count();
      if($colegiatura>0)
        return 0;
      else
      {
        $alumno = Alumno :: findOrFail($request->id);
         $alumno -> estado = 0;
         $alumno -> save();
        return 1;
       } 
      }
    
    
  
 
}
