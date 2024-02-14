<?php

namespace App\Http\Controllers;

use App\Models\Precio;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PrecioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('precios');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function listado_precios(){
      $precios=Precio::select('id',
                              'monto',
                              'descripcion',
                              'cantidad_meses',
                              'es_promosion')
                        ->where('estado',1)
                        ->get();
        return $precios;
    }

    public function listado_precios_membresia()
    {
        $precios=Precio::select('id',
                              'monto',
                              'descripcion',
                              'cantidad_meses',
                              'es_promosion')
                        ->where('estado',1)
                        ->where('id','>',1)
                        ->get();
        return $precios;
    }
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
            'monto'=>['required','numeric'],
            'descripcion'=>['required','string','max:255'],
            'cantidad_meses'=>['required','int'],
           // 'telefono'=>['required','string','min:5'],
            'es_promosion'=>['required'],
          ]);
          $date=Carbon::now();
          $precio = new Precio;
       $precio->monto=$request->monto;
       $precio->descripcion=$request->descripcion;
       $precio->cantidad_meses=$request->cantidad_meses;
       $precio->es_promosion=$request->es_promosion;
       $precio->fecha_registro=Carbon::parse($date);
       $precio->estado=1;
       $precio->usuario_id=auth()->user()->id;;

       $precio->save();
       return $precio->id;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $precio)
    {
        $precios=Precio::select('id',
                              'monto',
                              'descripcion',
                              'cantidad_meses',
                              'es_promosion')
                        ->where('estado',1)
                        ->where('id','=',$precio)
                        ->first();
        return $precios;
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
    public function update(Request $request, Precio $precio)
    {
        $data=request()->validate([
            'monto'=>['required','numeric'],
            'descripcion'=>['required','string','max:255'],
            'cantidad_meses'=>['required','int'],
            'es_promosion'=>['required'],
          ]);


        $precio->monto           =$request->monto;// $data['name'];
        $precio->descripcion     =$request->descripcion;//$data['apellido'];
        $precio->cantidad_meses  =$request->cantidad_meses;//$data['ci'];
        $precio->es_promosion    =$request->es_promosion; //$data['telefono'];
        $precio->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Precio $precio)
    {
        $precio->estado           =0;
        $precio->save();
    }
}
