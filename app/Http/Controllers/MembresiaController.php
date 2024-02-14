<?php

namespace App\Http\Controllers;

use App\Models\Membresia;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MembresiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $data=request()->validate([
            'fecha_inicio'=>['required'],
            'fecha_fin'=>['required'],
            'tipo'=>['required'],
            'monto_total'=>['required'],
            'precio_id'=>['required']
          ]);

          $date=Carbon::now();
          // obtener la diferencia de fechas
          $finicio = Carbon::parse($request->fecha_inicio);
          $ffin = Carbon::parse($request->fecha_fin);
          $fecha_actual=Carbon::parse($date);

          //Pregunta si la fecha final es mayor a fecha inicio
          if ($ffin->gt($finicio))
          {
            $cantidad_meses= $finicio->diffInMonths($ffin);

            if ($cantidad_meses<1) {
                return -1;
            }
            //pregunta si fecha inicio es menor a fecha actual
            if ($finicio->lessThan($fecha_actual)){
                return -2;
            }


            $monto_unitario=($request->monto_total/$cantidad_meses);
            $membresia = new Membresia;
            $membresia->fecha_inicio   =$request->fecha_inicio;
            $membresia->fecha_fin      =$request->fecha_fin;
            $membresia->fecha_registro =$date;
            $membresia->cant_meses     =$cantidad_meses;

            $membresia->tipo           =$request->tipo;
            $membresia->monto_unitario =$monto_unitario;
            $membresia->monto_total    =$request->monto_total;
            $membresia->estado         =1;
            $membresia->cliente_id     =$request->cliente_id;

            $membresia->tipo_membresia =1;
            $membresia->precio_id      =$request->precio_id;
            $membresia->personal_id    =1;
            $membresia->membresia_id   =0;

            $membresia->save();
            return $membresia->id;
          }//fin de verificacion de fechas
          else{
            return 0;
          }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
