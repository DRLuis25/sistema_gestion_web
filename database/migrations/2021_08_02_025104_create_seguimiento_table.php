<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeguimientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rol', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('process_map_id'); //mapa proceso id
            $table->string('name');
            $table->timestamps();
            $table->foreign('process_map_id')->references('id')->on('process_maps');
        });
        Schema::create('seguimiento', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('process_id'); //mapa proceso id
            $table->unsignedBigInteger('rol_id'); //rol id
            $table->string('activity');
            $table->integer('flow_id');
            $table->decimal('time', 12, 2);
            $table->timestamps();
            $table->foreign('process_id')->references('id')->on('process');
            $table->foreign('rol_id')->references('id')->on('rol');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seguimiento');
    }
}
