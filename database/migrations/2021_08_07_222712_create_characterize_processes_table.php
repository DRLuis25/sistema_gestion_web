<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharacterizeProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hoja_caracterizacion_procesos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('process_map_id'); //mapa proceso id
            $table->unsignedBigInteger('process_id'); //proceso id
            $table->unsignedBigInteger('matriz_priorizado_id'); //matriz_priorizado id
            $table->string('propietario')->nullable();
            $table->string('mision')->nullable();
            $table->string('empieza')->nullable();
            $table->string('incluye')->nullable();
            $table->string('termina')->nullable();
            $table->longText('entradas_data')->nullable();
            $table->longText('proveedores_data')->nullable();
            $table->longText('salidas_data')->nullable();
            $table->longText('clientes_data')->nullable();
            $table->longText('inspecciones_data')->nullable();
            $table->longText('registros_data')->nullable();
            $table->longText('variables_control_data')->nullable();
            $table->longText('indicadores_data')->nullable();
            $table->longText('data')->nullable();
            $table->boolean('adjunto');
            $table->timestamps();
            $table->foreign('process_map_id')->references('id')->on('process_maps');
            $table->foreign('process_id')->references('id')->on('process');
            $table->foreign('matriz_priorizado_id')->references('id')->on('matriz_priorizado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('characterize_processes');
    }
}
