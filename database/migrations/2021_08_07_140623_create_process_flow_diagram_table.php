<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessFlowDiagramTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('process_flow_diagram', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('process_map_id'); //mapa proceso id
            $table->unsignedBigInteger('process_id'); //proceso id
            $table->timestamps();
            $table->longText('data');
            //$table->softDeletes();
            $table->foreign('process_map_id')->references('id')->on('process_maps');
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
        Schema::dropIfExists('process_flow_diagram');
    }
}
