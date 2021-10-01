<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('invoices')){
            Schema::create('invoices', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('invoice_id');
                $table->unsignedBigInteger('customer_id');
                $table->date('transaction_date');
                $table->date('due_date');
                $table->date('send_date')->nullable();
                $table->unsignedBigInteger('category_id');
                $table->string('reference_no')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
