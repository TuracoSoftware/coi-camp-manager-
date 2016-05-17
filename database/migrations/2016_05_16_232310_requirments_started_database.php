<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RequirmentsStartedDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('requirments_started', function (Blueprint $table) {
        $table->increments('id');
        $table->string('title_req');
        $table->integer('test_if_complete')->default(1);
        $table->integer('meritB_id')->unsigned();

        $table->foreign('meritB_id')->references('id')->on('merit_badge');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
