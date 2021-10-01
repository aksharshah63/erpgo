<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkExperienceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('work_experience')){
            Schema::create('work_experience', function (Blueprint $table) {
                $table->id();
                $table->string('previous_company');
                $table->string('job_title');
                $table->date('from');
                $table->date('to');
                $table->text('job_description');
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
        Schema::dropIfExists('work_experience');
    }
}
