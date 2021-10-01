<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHolidaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('holidays')){
            Schema::create('holidays', function (Blueprint $table) {
                $table->id();
                $table->string('holiday_name');
                $table->date('start_date');
                $table->boolean('range')->nullable();
                $table->date('end_date')->nullable();
                $table->text('description')->nullable();
                $table->integer('days');
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
        Schema::dropIfExists('holidays');
    }
}
