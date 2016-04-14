<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReqTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('requirements', function(Blueprint $table) {
        $table->increments('id');
        $table->string('requirement_tittle');
        $table->string('requirement_descritpion');
        $table->unsignedInteger('badge_id')->nullable();
        $table->unsignedInteger('sub_requirement_id')->nullable();
        $table->foreign('badge_id')->references('id')->on('badges');
        $table->foreign('sub_requirement_id')->references('id')->on('sub_requirements');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
