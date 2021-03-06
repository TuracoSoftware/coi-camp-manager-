<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FinalMakeMeritBadgeStarted extends Migration
{
  public function up() {
    Schema::create('merit_badge_started', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('scout_id')->unsigned();
      $table->integer('meritbadge_id')->unsigned();
      $table->timestamps();

      $table->foreign('meritbadge_id')->references('id')->on('merit_badge');
      $table->foreign('scout_id')->references('id')->on('scouts');
    });
  }
}
