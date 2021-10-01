<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalenderSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('calender_schedules')){
            Schema::create('calender_schedules', function (Blueprint $table) {
                $table->id();
                $table->string('type')->nullable();
                $table->date('date')->nullable();
                $table->time('time')->nullable();
                $table->text('note')->nullable();
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
        Schema::dropIfExists('calender_schedules');
    }
}
