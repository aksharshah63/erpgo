<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('bank_accounts')){
            Schema::create('bank_accounts', function (Blueprint $table) {
                $table->id();
                $table->string('holder_name');
                $table->string('bank_name');
                $table->string('account_number');
                $table->float('opening_balance', 15, 2)->default('0.00');
                $table->string('contact_number');
                $table->text('bank_address');
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
        Schema::dropIfExists('bank_accounts');
    }
}
