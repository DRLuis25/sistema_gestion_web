<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Empresas
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('ruc',11)->unique();
            $table->string('name',60);
            $table->string('description',100)->nullable();
            $table->string('phone',17)->nullable();
            $table->string('address',100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
