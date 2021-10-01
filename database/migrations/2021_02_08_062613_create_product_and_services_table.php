<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAndServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('product_and_services')){
            Schema::create('product_and_services', function (Blueprint $table) {
                $table->id();
                $table->string('product_name');
                $table->string('product_type');
                $table->unsignedBigInteger('category')->nullable();
                $table->unsignedBigInteger('cost_price')->nullable();
                $table->unsignedBigInteger('sale_price');
                $table->string('tax_rate_id')->nullable();
                $table->unsignedBigInteger('created_by');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_and_services');
    }
}
