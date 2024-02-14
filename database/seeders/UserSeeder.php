<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Personal;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //User::factory(50)->create();
        $user=User::create([
            'name'=>'Any',
            'email'=>'any2@gmail.com',
            'password'=>Hash::make('any123456'),
            'created_at'=> date('Y-m-d H:i:s'),
            'updated_at'=> date('Y-m-d H:i:s')

        ]);

        $personal=Personal::create([
            'name'=>'Any',
            'apellido'=>'Salas',
            'tipo'=>1, //1 = admin, 2=recepcionista
            'telefono'=>'65656565',
            'password'=>'any123456',
            'estado'=>1,
            'user_id'=>$user->id,
            'user_reg'=>1,
            'created_at'=> date('Y-m-d H:i:s'),
            'updated_at'=> date('Y-m-d H:i:s')

        ]);
    }
}
