<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('bill_payments')){
            Schema::create('bill_payments', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('bill_id');
                $table->date('date');
                $table->float('amount')->default('0.00');
                $table->integer('account_id')->nullable();
                $table->integer('payment_method')->nullable();
                $table->string('reference')->nullable();
                $table->text('description')->nullable();
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
        Schema::dropIfExists('bill_payments');
    }
}
