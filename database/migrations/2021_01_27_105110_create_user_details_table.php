<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('user_details')){
            Schema::create('user_details', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->string('image')->default('avatar.png')->nullable();
                $table->unsignedBigInteger('department')->nullable();
                $table->unsignedBigInteger('designation')->nullable();
                $table->string('location')->nullable();
                $table->string('reporting_to')->nullable();
                $table->string('source_of_hire')->nullable();
                $table->string('pay_rate')->nullable();
                $table->string('pay_type')->nullable();
                $table->string('father_name')->nullable();
                $table->string('mother_name')->nullable();
                $table->string('mobile')->nullable();
                $table->string('phone')->nullable();
                $table->date('date_of_birth')->nullable();
                $table->string('nationality')->nullable();
                $table->string('gender')->nullable();
                $table->string('marital_status')->nullable();
                $table->string('hobbies')->nullable();
                $table->string('website')->nullable();
                $table->string('address1')->nullable();
                $table->string('address2')->nullable();
                $table->string('city')->nullable();
                $table->string('country')->nullable();
                $table->string('state')->nullable();
                $table->string('zip_code')->nullable();
                $table->text('biography')->nullable();
                $table->string('policy_id')->nullable();
                $table->timestamps();
                // $table->foreign('user_id')->references('id')->on('employees')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('employee_details');
    }
}
