<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Personal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function listar()
    {
       // return User::all();
        $personal=Personal::select('users.id',
                                   'users.name',
                                   'apellido',
                                   'tipo',
                                   'telefono',
                                   'personals.password',
                                   'users.email',
                                   'personals.created_at')
                            ->join('users','users.id','=','personals.user_id')
                            ->where('personals.estado',1)
                            ->get();
        return $personal;
    }

    public function guardar()
    {
        dd('ddc');
        // dd($request);
        // $data=request()->validate([
        //   'name'=>['required','string','max:255'],
        //   'email'=>['required','string','email','max:255','unique:users'],
        //   'password'=>['required','string','min:8'],
        // ]);

        // return User::create([
        //    'name'=>$data['name'],
        //    'email'=>$data['enail'],
        //    'password'=>Hash::make($data['password']),
        // ]);
    }
}
