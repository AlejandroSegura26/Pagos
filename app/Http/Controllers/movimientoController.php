<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movimiento;
use App\Cartera;
class movimientoController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio; 
        if ($buscar == '') 
        {
             $movimiento =Movimiento:: 
          select('*')
              ->orderBy('movimientos.id','desc')
            ->paginate(30);
        }
        else 
        {
            $movimiento = Movimiento::where('movimientos.'.$criterio,'like','%'.$buscar.'%')
             ->orderBy('movimientos.id','desc')
            ->paginate(30);
        }
        $cartera = Cartera :: findOrFail('1');
           return [
               'pagination' => [
                   'total' => $movimiento->total(),
                   'current_page' => $movimiento->currentPage(),
                   'per_page' => $movimiento->perPage(),
                   'last_page' => $movimiento->lastPage(),
                   'from' => $movimiento->firstItem(),
                   'to' => $movimiento->lastItem(),
               ],
               'movimiento' => $movimiento,
                'saldo'=> $cartera->saldo
           ];
       }
  
}
