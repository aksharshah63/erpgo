<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerformanceReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {    
        if(!Schema::hasTable('performance_reviews')){
            Schema::create('performance_reviews', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->date('review_date');
                $table->unsignedBigInteger('reporting_to')->nullable();
                $table->string('job_knowledge')->nullable();
                $table->string('work_quality')->nullable();
                $table->string('attendence_punctuality')->nullable();
                $table->string('communication_listening')->nullable();
                $table->string('dependability')->nullable();
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
        Schema::dropIfExists('performance_reviews');
    }
}
