<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Proveedores
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('ruc',11)->unique();
            $table->string('name',50);
            $table->string('contact_name',50)->nullable();
            $table->string('contact',17)->nullable();
            $table->string('email')->nullable();
            $table->string('address',100)->nullable();
            $table->unsignedBigInteger('company_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('company_id')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suppliers');
    }
}
