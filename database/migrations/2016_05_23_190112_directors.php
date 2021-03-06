<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Directors extends Migration
{
  public function up() {
    Schema::create('directors', function (Blueprint $table) {
      $table->increments('id');
      $table->string('description');
      $table->string('department')->nullable();
      $table->integer('user_id')->unsigned();

      $table->foreign('user_id')->references('id')->on('users');
    });
  }
}
