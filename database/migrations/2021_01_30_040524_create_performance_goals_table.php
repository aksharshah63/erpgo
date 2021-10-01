<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerformanceGoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('performance_goals')){
            Schema::create('performance_goals', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->date('set_date');
                $table->date('completion_date');
                $table->text('goal_description')->nullable();
                $table->text('employee_assessment')->nullable();
                $table->unsignedBigInteger('supervisor')->nullable();
                $table->text('supervisor_assessment')->nullable();
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
        Schema::dropIfExists('performance_goals');
    }
}
