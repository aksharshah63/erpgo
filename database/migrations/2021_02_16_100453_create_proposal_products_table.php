<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProposalProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('proposal_products')){
            Schema::create('proposal_products', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('proposal_id');
                $table->integer('product_id');
                $table->integer('quantity');
                $table->string('tax')->default('0.00');
                $table->float('price')->default('0.00');
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
        Schema::dropIfExists('proposal_products');
    }
}
