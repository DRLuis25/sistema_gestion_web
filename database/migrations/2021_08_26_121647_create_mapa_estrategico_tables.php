<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMapaEstrategicoTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Frecuencia: Diaria, Semanal, Mensual, Anual
        Schema::create('frequencies', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->timestamps();
            $table->softDeletes();
        });
        //Perspectivas: Financiera, Clientes, Procesos internos, Aprendizaje y crecimiento
        Schema::create('perspectives', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('process_id');
            $table->string('descripcion');
            $table->integer('orden');
            $table->foreign('process_id')->references('id')->on('process');
        });
        //Objetivos
        Schema::create('objectives', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('process_id');
            $table->unsignedBigInteger('perspective_id');
            $table->string('descripcion');//$table->string('relaciona')[1,2]
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('process_id')->references('id')->on('process');
            $table->foreign('perspective_id')->references('id')->on('perspectives');
        });
        Schema::create('objective_objectives', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('objective_id');
            $table->unsignedBigInteger('objective_id2');
            $table->timestamps();
            $table->foreign('objective_id')->references('id')->on('objectives');
            $table->foreign('objective_id2')->references('id')->on('objectives');
        });
        Schema::create('indicators', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('process_id');
            $table->unsignedBigInteger('frecuency_id');
            $table->string('descripcion');
            $table->text('formula');
            $table->text('linea_base');
            $table->string('objetivo');
            $table->string('responsable');
            $table->string('meta');
            $table->text('iniciativas'); //[]
            $table->integer('rojo');
            $table->integer('verde');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('process_id')->references('id')->on('process');
            $table->foreign('frecuency_id')->references('id')->on('frequencies');
        });
        Schema::create('data_fuente', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('indicator_id');
            $table->timestamp('fecha');
            $table->integer('valor');
            $table->string('estado')->nullable();
            $table->timestamps();
            $table->foreign('indicator_id')->references('id')->on('indicators');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mapa_estrategico_tables');
    }
}
