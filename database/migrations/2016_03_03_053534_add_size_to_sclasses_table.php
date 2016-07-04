<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSizeToSclassesTable extends Migration
{
  public function up() {
    Schema::table('sclasses', function (Blueprint $table) {
      $table->integer('size');
    });
  }
}
