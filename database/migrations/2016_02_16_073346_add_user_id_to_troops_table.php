<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToTroopsTable extends Migration
{
  public function up() {
    Schema::table('troops', function (Blueprint $table) {

      $table->unsignedInteger('user_id')->nullable();

      $table->foreign('user_id')->references('id')->on('users');
    });
  }
}
