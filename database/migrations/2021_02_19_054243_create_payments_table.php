<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('payments')){
            Schema::create('payments', function (Blueprint $table) {
                $table->id();
                $table->date('date');
                $table->float('amount',15,2)->default('0.00');
                $table->integer('account_id');
                $table->integer('vendor_id');
                $table->text('description');
                $table->integer('category_id');
                $table->string('recurring')->nullable();
                $table->integer('payment_method');
                $table->string('reference');
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
        Schema::dropIfExists('payments');
    }
}
