<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('vendor_details')){
            Schema::create('vendor_details', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('vendor_id');
                $table->string('phone_no')->nullable();
                $table->text('image')->nullable();
                $table->string('company')->nullable();
                $table->string('mobile_no')->nullable();
                $table->string('website')->nullable();
                $table->text('notes')->nullable();
                $table->string('fax_no')->nullable();
                $table->text('address1')->nullable();
                $table->text('address2')->nullable();
                $table->string('city')->nullable();
                $table->string('country')->nullable();
                $table->string('state')->nullable();
                $table->string('post_code')->nullable();
                $table->timestamps();
                $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('vendor_details');
    }
}
