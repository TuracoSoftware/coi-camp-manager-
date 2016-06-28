<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTimestampsToStaffTable extends Migration
{
  public function up()
  {
    Schema::table('staff', function (Blueprint $table) {
      $table->timestamps();
    });
  }
}
