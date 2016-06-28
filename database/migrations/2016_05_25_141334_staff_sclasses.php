<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StaffSclasses extends Migration
{
  public function up() {
    for($i = 1; $i < 8; $i++) {
      Schema::create('staff_sclass_' . $i, function (Blueprint $table) {
          $table->integer('staff_id')->unsigned()->nullable();
          $table->integer('sclass_id')->unsigned()->nullable();

          $table->foreign('sclass_id')->references('id')->on('sclasses');
          $table->foreign('staff_id')->references('id')->on('staff');
      });
    }
  }
}
