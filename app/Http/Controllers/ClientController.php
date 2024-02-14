<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Database\Query\JoinClause;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       //return Client::all();
        return view('clients');
    }
    public function listado_clientes()
    {
        $clientes=Client::select('clients.id',
                                 'clients.name',
                                 'apellido',
                                 'ci',
                                 'telefono',
                                 'sexo',
                                 'membresias.id as membresia')
                                //->leftjoin('membresias','membresias.cliente_id','=','clients.id')
                                ->leftjoin('membresias', function(JoinClause $join){
                                 $join->on('clients.id', '=', 'membresias.cliente_id')->where('membresias.estado',1);
                                })
                                //->where('membresias.estado',1)
                                ->where('clients.estado',1)
                                ->get();
        return $clientes;
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
            'name'=>['required','string','max:255'],
            'apellido'=>['required','string','max:255'],
            'ci'=>['required','string','min:5'],
           // 'telefono'=>['required','string','min:5'],
            'sexo'=>['required'],
          ]);

          $client = new Client;
       $client->name=$request->name;
       $client->apellido=$request->apellido;
       $client->ci=$request->ci;
       $client->telefono=$request->telefono;
       $client->sexo=$request->sexo;
       $client->estado=1;
      
       $client->save();
       return $client->id;
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
    public function update(Request $request, Client $idcli)
    {
        $data=request()->validate([
            'name'=>['required','string','max:255'],
            'apellido'=>['required','string','max:255'],
            'ci'=>['required','string','min:5'],
           // 'telefono'=>['required','string','min:5'],
            'sexo'=>['required'],
          ]);


        $idcli->name     =$request->name;// $data['name'];
        $idcli->apellido =$request->apellido;//$data['apellido'];  
        $idcli->ci       =$request->ci;//$data['ci'];
        $idcli->telefono =$request->telefono; //$data['telefono'];
        $idcli->sexo     =$request->sexo;//$data['sexo']; 
        $idcli->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $idcli)
    {
        $idcli->estado =0;//$data['sexo']; 
        $idcli->save();
    }
}
