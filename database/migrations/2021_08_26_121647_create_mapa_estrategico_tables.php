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
        Schema::create('perspectives_companies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->string('descripcion');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->timestamps();
        });
        //Perspectivas: Financiera, Clientes, Procesos internos, Aprendizaje y crecimiento
        Schema::create('perspectives', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('matriz_priorizado_id');
            $table->unsignedBigInteger('process_id');
            $table->unsignedBigInteger('perspective_company_id');
            $table->integer('orden');
            $table->unique(['matriz_priorizado_id', 'process_id','perspective_company_id'],'perspectives_unique_key');
            $table->foreign('matriz_priorizado_id')->references('id')->on('matriz_priorizado');
            $table->foreign('process_id')->references('id')->on('process');
            $table->foreign('perspective_company_id')->references('id')->on('perspectives_companies');
            $table->timestamps();
        });

        Schema::create('objectives_companies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->string('descripcion');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->timestamps();
        });
        //Objetivos
        Schema::create('objectives', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('matriz_priorizado_id');
            $table->unsignedBigInteger('process_id');
            $table->unsignedBigInteger('perspective_id');
            $table->unsignedBigInteger('objectives_company_id')->nullable();
            $table->string('descripcion')->nullable();
            $table->boolean('nuevo');
            $table->text('efecto')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('matriz_priorizado_id')->references('id')->on('matriz_priorizado');
            $table->foreign('process_id')->references('id')->on('process');
            $table->foreign('perspective_id')->references('id')->on('perspectives');
            $table->foreign('objectives_company_id')->references('id')->on('objectives_companies');
        });
        Schema::create('indicators', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('matriz_priorizado_id');
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
            $table->foreign('matriz_priorizado_id')->references('id')->on('matriz_priorizado');
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
        Schema::create('historial_maps',function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('matriz_priorizado_id');
            $table->unsignedBigInteger('process_id');
            $table->string('description');//comentario nullable
            $table->longText('data');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('matriz_priorizado_id')->references('id')->on('matriz_priorizado');
            $table->foreign('process_id')->references('id')->on('process');
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
