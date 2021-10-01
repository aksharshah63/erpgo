<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('proposals')){
            Schema::create('proposals', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('proposal_id');
                $table->unsignedBigInteger('customer_id');
                $table->date('transaction_date');
                $table->date('send_date')->nullable();
                $table->unsignedBigInteger('category_id');
                $table->text('billing_address')->nullable();
                $table->string('discount_type')->default('discount-percent')->nullable();
                $table->integer('discount_value')->nullable();
                $table->integer('status')->default('0');
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
        Schema::dropIfExists('proposals');
    }
}
