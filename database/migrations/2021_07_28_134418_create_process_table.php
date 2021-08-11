<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('process_maps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('business_unit_id'); //Unidad negocio_id
            $table->string('period',20);
            $table->timestamp('launch');
            $table->boolean('status')->default(false);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('business_unit_id')->references('id')->on('business_units');
        });
        Schema::create('process', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('process_map_id'); //Unidad negocio_id
            $table->string('name');
            $table->string('description');
            $table->unsignedBigInteger('parent_process_id')->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('process_map_id')->references('id')->on('process_maps');
        });
        Schema::create('historial_process_map', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('process_map_id'); //process_map_id
            $table->string('description',80)->nullable();//comentario nullable
            $table->longText('data');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('process_map_id')->references('id')->on('process_maps');
        });
        Schema::create('types', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->timestamps();
        });
        Schema::create('process_type', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('process_id');
            $table->unsignedBigInteger('type_id');
            $table->timestamps();
            $table->foreign('process_id')->references('id')->on('process');
            $table->foreign('type_id')->references('id')->on('types');
        });
        Schema::create('criterios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('process_map_id'); //mapa proceso id
            $table->string('name');
            $table->string('description');
            $table->string('peso');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('process_map_id')->references('id')->on('process_maps')->onDelete('cascade');;
        });
        Schema::create('process_criterio', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('process_map_id'); //mapa proceso id
            $table->longText('data'); //todas las relaciones alv
            $table->longText('process_id_data');//id procesos ordenados por values
            $table->longText('process_values_data'); //valores procesos ordenados
            $table->timestamps();
            $table->foreign('process_map_id')->references('id')->on('process_maps');
        });
        Schema::create('matriz_priorizado', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('process_map_id'); //mapa proceso id
            $table->unsignedBigInteger('process_criterio_id'); //matriz procesos priorizados
            $table->string('description')->nullable();//id procesos priorizados
            $table->longText('process_id_data');//id procesos priorizados
            $table->longText('process_values_data'); //valores procesos priorizados
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('process_map_id')->references('id')->on('process_maps');
            $table->foreign('process_criterio_id')->references('id')->on('process_criterio');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('process');
    }
}
