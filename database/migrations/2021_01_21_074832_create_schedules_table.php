<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('schedules')){
            Schema::create('schedules', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->boolean('all_day')->nullable();
                $table->date('start_date');
                $table->time('start_time')->nullable();
                $table->date('end_date');
                $table->time('end_time')->nullable();
                $table->text('note');
                $table->string('agent_or_manager');
                $table->string('schedule_type');
                $table->boolean('all_notification')->nullable();
                $table->string('email')->nullable();
                $table->string('module_type');
                $table->unsignedBigInteger('module_id');
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
        Schema::dropIfExists('schedules');
    }
}
