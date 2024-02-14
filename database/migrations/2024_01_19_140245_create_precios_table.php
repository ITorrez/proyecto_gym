<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('precios', function (Blueprint $table) {
            $table->id();
            $table->decimal('monto',18,2)->comment('precio');
            $table->date('fecha_registro');
            $table->string('descripcion');
            $table->integer('cantidad_meses')->comment('cantidad de meses para el precio');
            $table->integer('estado');
            $table->integer('usuario_id')->comment('usuario quien hizo el registro');
            $table->integer('es_promosion')->comment('1=es un precio para una promocion, 0=no es para promocion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('precios');
    }
};
