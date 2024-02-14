<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Personal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return User::all();
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
           'email'=>['required','string','email','max:255','unique:users'],
           'password'=>['required','string','min:8'],
           'tipo'=>['required'],
           'apellido'=>['required'],
           'telefono'=>['required'],
         ]);

        /* return User::create([
            'name'=>$data['name'],
            'email'=>$data['enail'],
            'password'=>Hash::make($data['password']),
         ]);*/



       $user = new User;
       $user->name=$request->name;
       $user->email=$request->email;
       $user->password=Hash::make($request->password);
       $user->save();

       $personal=new Personal;
       $personal->name=$request->name;
       $personal->apellido=$request->apellido;
       $personal->tipo=$request->tipo;
       $personal->telefono=$request->telefono;
       $personal->password=$request->password;
       $personal->estado=1;
       $personal->user_id=$user->id;
       $personal->user_reg=auth()->user()->id;
       $personal->save();

       return $user->id;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

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
    public function update(Request $request, User $idUser)
    {
       // dd('dvdfv');
        $data=request()->validate([
            'name'=>['required','string','max:255'],
            'apellido'=>['required','string','max:255'],
            'telefono'=>['string','max:255'],
            'tipo'=>['required'],
            'email'=>['required','string','email','max:255','unique:users,email,'.$idUser->id],
            'password'=>['required','string','min:8'],

          ]);

          /*$data=request()->validate([
            'name'=>'required|min:6',
            'categoria'=>'required',
            'preparacion'=>'required',
            'ingredientes'=>'required'

        ]);*/

        $idUser->name=$data['name'];// $data['name'];
        $idUser->email=$data['email'];  //$data['email'];
        $idUser->password=Hash::make($data['password']);  //$data['email'];
        $idUser->save();

        $per=Personal::select('id',
                              'name',
                              'apellido',
                              'tipo',
                              'telefono',
                              'password')
                        ->where('user_id',$idUser->id)
                        ->first();


        $personal=Personal::find($per->id);
        $personal->name=$data['name'];
        $personal->apellido=$data['apellido'];
        $personal->tipo=$data['tipo'];
        $personal->telefono=$data['telefono'];
        $personal->password=$data['password'];
        $personal->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $idUser)
    {
        $idUser->delete();
        $per=Personal::select('id',
                              'name',
                              'apellido',
                              'tipo',
                              'telefono',
                              'password')
                        ->where('user_id',$idUser->id)
                        ->first();
        $personal=Personal::find($per->id);
        $personal->estado=0;
        $personal->save();
    }
}
