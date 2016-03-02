<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTroopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('troops', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('troop');
          $table->string('council');
          $table->string('scout_master_first_name');
          $table->string('scout_master_last_name');
          $table->string('scout_master_phone');
          $table->string('scout_master_email');
          $table->integer('week_attending_camp');
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
        Schema::drop('troops');
    }
}
