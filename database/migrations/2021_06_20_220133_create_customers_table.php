<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Clientes
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('dni', 8)->unique();
            $table->string('name',100);
            $table->string('last_name',100);
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
        Schema::dropIfExists('customers');
    }
}
