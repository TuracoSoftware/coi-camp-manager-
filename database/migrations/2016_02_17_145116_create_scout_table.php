<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScoutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('scouts', function(Blueprint $table) {
        $table->increments('id');
        $table->string('firstname');
        $table->string('lastname');
        $table->integer('age');
        $table->unsignedInteger('troop_id')->nullable();
        $table->foreign('troop_id')->references('id')->on('troops');
        $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('scouts');
    }
}
