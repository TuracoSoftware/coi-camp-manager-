<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('badges', function(Blueprint $table) {
        $table->increments('id');
        $table->string('badge_tittle');
        $table->string('badge_description');
        $table->unsignedInteger('sclass_id')->nullable();
        $table->unsignedInteger('requirement_id')->nullable();
        $table->foreign('sclass_id')->references('id')->on('sclass');
        $table->foreign('requirement_id')->references('id')->on('requirements');
      });
    }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::drop('badges');
    }
}
