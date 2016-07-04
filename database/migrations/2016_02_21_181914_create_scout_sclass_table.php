<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScoutSclassTable extends Migration
{
  public function up() {
    Schema::create('scout_sclass', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('scout_id')->unsigned()->nullable();
      $table->integer('sclass_id')->unsigned()->nullable();

      $table->foreign('sclass_id')->references('id')->on('sclasses');
      $table->foreign('scout_id')->references('id')->on('scouts');
    });
  }
}
