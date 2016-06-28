<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImgFileToMeritBadge extends Migration
{
  public function up()
  {
    Schema::table('merit_badge', function (Blueprint $table) {
      $table->string('path_name')->nullable();
    });
  }
}
