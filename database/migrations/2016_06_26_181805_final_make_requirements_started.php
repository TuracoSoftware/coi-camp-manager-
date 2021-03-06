<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FinalMakeRequirementsStarted extends Migration
{
  public function up() {
    Schema::create('requirments_started', function (Blueprint $table) {
      $table->increments('id');
      $table->string('title');
      $table->string('description')->nullable();
      $table->integer('test_if_complete');
      $table->integer('meritB_id')->unsigned();
      $table->timestamps();

      $table->foreign('meritB_id')->references('id')->on('merit_badge_started');
    });
  }
}
