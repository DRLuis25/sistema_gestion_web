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
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('business_unit_id'); //Unidad negocio_id
            $table->string('period',20);
            $table->timestamp('launch');
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('business_unit_id')->references('id')->on('business_units');
        });
        Schema::create('supply_chain_customers', function (Blueprint $table) {
            //Clientes de la cadena de suministro
            $table->id();
            $table->unsignedBigInteger('supply_chain_id'); //cadena suministro id
            $table->unsignedBigInteger('customer_id'); //cliente_id
            $table->unsignedBigInteger('parent_customer_id')->default(0);//cliente_padre_id nullable
            $table->unsignedBigInteger('level');//nivel_id
            $table->timestamps();
            $table->unique(['supply_chain_id','customer_id','parent_customer_id','level'],'fk_unique_supply_chain_customer');
            $table->foreign('supply_chain_id')->references('id')->on('supply_chains');
            $table->foreign('customer_id')->references('id')->on('customers');
        });
        Schema::create('supply_chain_suppliers', function (Blueprint $table) {
            //Proveedores de la cadena de suministro
            $table->id();
            $table->unsignedBigInteger('supply_chain_id'); //cadena suministro_id
            $table->unsignedBigInteger('supplier_id'); //proveedor_id
            $table->unsignedBigInteger('parent_supplier_id')->default(0); //proveedor_padre_id nullable
            $table->unsignedBigInteger('level'); //nivel_id
            $table->timestamps();
            $table->unique(['supply_chain_id','supplier_id','parent_supplier_id','level'],'fk_unique_supply_chain_suppliers');
            $table->foreign('supply_chain_id')->references('id')->on('supply_chains');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
        });
        Schema::create('historial', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supply_chain_id'); //unidad negocio_id
            $table->string('description',80)->nullable();//comentario nullable
            //contenido image/path
            $table->longText('data');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('supply_chain_id')->references('id')->on('supply_chains');
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
