<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('contact_groups')){
            Schema::create('contact_groups', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->text('description')->nullable();
                $table->boolean('private')->nullable();
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
        Schema::dropIfExists('contact_groups');
    }
}
