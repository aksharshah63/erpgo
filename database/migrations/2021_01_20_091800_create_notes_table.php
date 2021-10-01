<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('notes')){
            Schema::create('notes', function (Blueprint $table) {
                $table->id();
                $table->text('note');
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
        Schema::dropIfExists('notes');
    }
}
