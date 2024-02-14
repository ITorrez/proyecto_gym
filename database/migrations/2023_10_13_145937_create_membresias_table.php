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
        Schema::create('membresias', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->date('fecha_registro');
            $table->integer('cant_meses');
            $table->integer('tipo')->comment('1=gimnasion, 2=sumba');
            $table->decimal('monto_unitario',18,2)->comment('monto por mes');
            $table->decimal('monto_total',18,2)->comment('monto total, por todos los meses');
            $table->integer('estado')->comment('1=activo, 2=inactivo');
            $table->integer('cliente_id')->comment('identificador del cliente');
            $table->integer('personal_id')->comment('usuario quien hizo el registro');
            $table->integer('precio_id')->comment('precio desde la tabla precio');
            $table->integer('tipo_membresia')->comment('1=membresia, 2 =ampliacion');
            $table->integer('membresia_id')->comment('cuando es ampliacion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membresias');
    }
};
