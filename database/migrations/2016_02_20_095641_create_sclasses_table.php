<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSclassesTable extends Migration
{
  public function up() {
    Schema::create('sclasses', function(Blueprint $table) {
      $table->increments('id');
      $table->string('name');
      $table->string('description');
      $table->integer('min_age');
      $table->string('department')
      $table->integer('fee')->nullable();
      $table->string('day');
      $table->string('duration');
      $table->timestamps();
    });
  }
}
