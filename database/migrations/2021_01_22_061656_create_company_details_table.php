<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('company_details')){
            Schema::create('company_details', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('company_id');
                $table->string('phone_no')->nullable();
                $table->text('image')->nullable();
                $table->string('life_stage');
                $table->string('contact_owner');
                $table->string('mobile_no')->nullable();
                $table->string('website')->nullable();
                $table->string('fax_no')->nullable();
                $table->text('address1')->nullable();
                $table->text('address2')->nullable();
                $table->string('city')->nullable();
                $table->string('country')->nullable();
                $table->string('state')->nullable();
                $table->string('zip_code')->nullable();
                $table->text('assign_group')->nullable();
                $table->string('contact_source')->nullable();
                $table->string('others')->nullable();
                $table->text('notes')->nullable();
                $table->string('facebook')->nullable();
                $table->string('twitter')->nullable();
                $table->string('google_plus')->nullable();
                $table->string('linkedin')->nullable();
                $table->timestamps();
                $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('company_details');
    }
}
