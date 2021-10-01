<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('education')){
            Schema::create('education', function (Blueprint $table) {
                $table->id();
                $table->string('school_name');
                $table->string('degree');
                $table->string('field_of_study');
                $table->year('year_of_completion');
                $table->text('description')->nullable();
                $table->unsignedBigInteger('user_id');
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
        Schema::dropIfExists('education');
    }
}
