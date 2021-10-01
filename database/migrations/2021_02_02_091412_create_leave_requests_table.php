<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('leave_requests')){
            Schema::create('leave_requests', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->date('from');
                $table->date('to');
                $table->text('reason');
                $table->unsignedBigInteger('created_by');
                $table->string('status');
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
        Schema::dropIfExists('leave_requests');
    }
}
