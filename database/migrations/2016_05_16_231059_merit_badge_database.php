<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MeritBadgeDatabase extends Migration
{
  public function up() {
    Schema::create('merit_badge', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name');
    });
  }
}
