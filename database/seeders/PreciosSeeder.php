<?php

namespace Database\Seeders;

use App\Models\Precio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PreciosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $precio=Precio::create([
            'monto'=>10,
            'fecha_registro'=>date('Y-m-d H:i:s'),
            'descripcion'=>'Precio para eventuales',
            'cantidad_meses'=>0,
            'estado'=>1,
            'usuario_id'=>1,
            'es_promosion'=>0,
            'created_at'=> date('Y-m-d H:i:s'),
            'updated_at'=> date('Y-m-d H:i:s')

        ]);

        $precio=Precio::create([
            'monto'=>50,
            'fecha_registro'=>date('Y-m-d H:i:s'),
            'descripcion'=>'Precio para medio mes',
            'cantidad_meses'=>0,
            'estado'=>1,
            'usuario_id'=>1,
            'es_promosion'=>0,
            'created_at'=> date('Y-m-d H:i:s'),
            'updated_at'=> date('Y-m-d H:i:s')

        ]);

        $precio=Precio::create([
            'monto'=>100,
            'fecha_registro'=>date('Y-m-d H:i:s'),
            'descripcion'=>'Precio para mes',
            'cantidad_meses'=>1,
            'estado'=>1,
            'usuario_id'=>1,
            'es_promosion'=>0,
            'created_at'=> date('Y-m-d H:i:s'),
            'updated_at'=> date('Y-m-d H:i:s')

        ]);
    }
}
