<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RequirmentsDatabase extends Migration
{
  public function up() {
    Schema::create('requirments', function (Blueprint $table) {
      $table->increments('id');
      $table->string('title_req');
      $table->string('description');
      $table->integer('meritB_id')->unsigned();

      $table->foreign('meritB_id')->references('id')->on('merit_badge');
    });
  }
}
