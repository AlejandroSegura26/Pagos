<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Grupo;
use App\GrupoAlumno;
use App\Alumno;
class GrupoController extends Controller
{
   public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio; 
        if ($buscar == '') 
        {
             $grupo =Grupo::select('*')
              ->orderBy('grupos.id','desc')
            ->paginate(5);
        }
        else 
        {
            $grupo = Grupo::where('grupos.'.$criterio,'like','%'.$buscar.'%')
             ->orderBy('grupos.id','desc')
            ->paginate(5);
        }

           return [
               'pagination' => [
                   'total' => $grupo->total(),
                   'current_page' => $grupo->currentPage(),
                   'per_page' => $grupo->perPage(),
                   'last_page' => $grupo->lastPage(),
                   'from' => $grupo->firstItem(),
                   'to' => $grupo->lastItem(),
               ],
               'grupo' => $grupo
           ];
       }
  
     public function store(Request $request)
     {
        if (!$request->ajax()) return redirect('/'); 
         $grupo = new Grupo();
         $grupo -> nombre = $request -> nombre;
         $grupo -> descripcion = $request -> descripcion;
         $grupo -> save();
      }
  
    public function agregarAlumno(Request $request)
    {
      
        if (!$request->ajax()) return redirect('/'); 
         $grupo = new GrupoAlumno();
         $grupo -> grupo_id = $request -> id_grupo;
         $grupo -> alumno_id = $request -> id_alumno;
         $grupo -> save();
         $alumno = Alumno :: findOrFail($request->id_alumno);
         $alumno->grupo=1;
         $alumno -> save();
    }
  
   public function quitarAlumno(Request $request)
    {
      
        if (!$request->ajax()) return redirect('/'); 
          $deletedRows = GrupoAlumno::where('alumno_id','=',$request->id_alumno)
            ->where('grupo_id','=',$request->id_grupo)->delete();
          $alumno = Alumno :: findOrFail($request->id_alumno);
          $alumno->grupo=0;
        $alumno -> save();
    
    }
}
