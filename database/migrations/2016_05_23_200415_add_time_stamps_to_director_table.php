<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTimeStampsToDirectorTable extends Migration
{
  public function up() {
    Schema::table('directors', function (Blueprint $table) {
      $table->timestamps();
    });
  }
}
