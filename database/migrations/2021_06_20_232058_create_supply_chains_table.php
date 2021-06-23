<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplyChainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supply_chains', function (Blueprint $table) {
            //Cadena suministro
            //1 UN puede tener multiples cadenas
            $table->id();
            $table->unsignedBigInteger('business_unit_id'); //Unidad negocio_id
            $table->string('period',10); //Periodo max20
            $table->timestamp('launch');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('business_unit_id')->references('id')->on('business_units');
        });
        Schema::create('levels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supply_chain_id'); //cadena suministro id
            $table->boolean('type');// tipo (proveedor, cliente)
            $table->unsignedInteger('number');//numero
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('supply_chain_id')->references('id')->on('supply_chains');
        });
        Schema::create('supply_chain_customers', function (Blueprint $table) {
            //Clientes de la cadena de suministro
            $table->id();
            $table->unsignedBigInteger('supply_chain_id'); //cadena suministro id
            $table->unsignedBigInteger('customer_id'); //cliente_id
            $table->unsignedBigInteger('parent_customer_id')->default(null);//cliente_padre_id nullable
            $table->unsignedBigInteger('level_id');//nivel_id
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('supply_chain_id')->references('id')->on('supply_chains');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('parent_customer_id')->references('id')->on('customers');
            $table->foreign('level_id')->references('id')->on('levels');
        });
        Schema::create('supply_chain_suppliers', function (Blueprint $table) {
            //Proveedores de la cadena de suministro
            $table->id();
            $table->unsignedBigInteger('supply_chain_id'); //cadena suministro_id
            $table->unsignedBigInteger('supplier_id'); //proveedor_id
            $table->unsignedBigInteger('parent_supplier_id')->default(null); //proveedor_padre_id nullable
            $table->unsignedBigInteger('level_id'); //nivel_id
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('supply_chain_id')->references('id')->on('supply_chains');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
            $table->foreign('parent_supplier_id')->references('id')->on('suppliers');
            $table->foreign('level_id')->references('id')->on('levels');
        });
        Schema::create('historial', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('business_unit_id'); //unidad negocio_id
            $table->string('description',80)->nullable();//comentario nullable
            //contenido image/path
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('business_unit_id')->references('id')->on('business_units');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supply_chains');
    }
}
