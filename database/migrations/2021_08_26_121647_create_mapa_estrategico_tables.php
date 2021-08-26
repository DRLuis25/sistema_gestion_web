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
        //Indicadores
        Schema::create('frequencies', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('indicators', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('process_id');
            $table->unsignedBigInteger('frecuency_id');
            $table->string('descripcion');
            $table->string('objetivo');
            $table->string('responsable');
            $table->text('iniciativas');
            $table->text('linea_base');
            $table->string('meta');
            $table->text('formula');
            $table->integer('verde');
            $table->integer('rojo');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('process_id')->references('id')->on('process');
            $table->foreign('frecuency_id')->references('id')->on('frequencies');
        });
        Schema::create('perspectives', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('process_id');
            $table->string('descripcion');
            $table->foreign('process_id')->references('id')->on('process');
        });
        Schema::create('objectives', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('process_id');
            $table->unsignedBigInteger('perspective_id');
            $table->string('descripcion');
            $table->integer('level');
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
        Schema::create('data_fuente', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('indicator_id');
            $table->timestamp('fecha');
            $table->integer('valor');
            //$table->text('data');
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
