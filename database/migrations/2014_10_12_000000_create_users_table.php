<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'users', function (Blueprint $table){
            $table->id();
            $table->string('name');
            $table->string('user_id')->nullable();
            $table->string('user_type')->nullable();
            $table->string('user_status')->nullable();
            $table->date('date_of_hire')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('type')->default('User');
            $table->string('lang',10)->default('en');
            $table->string('website')->nullable();
            $table->string('profile')->nullable();
            $table->string('username')->nullable();
            $table->unsignedBigInteger('created_by')->default(0);
            $table->rememberToken();
            $table->timestamps();
        }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
