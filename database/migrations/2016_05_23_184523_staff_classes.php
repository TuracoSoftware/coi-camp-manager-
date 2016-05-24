<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StaffClasses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('staff_sclasses', function (Blueprint $table) {
        $table->integer('staff_id')->unsigned();
        $table->integer('sclass_id')->unsigned();

        $table->foreign('staff_id')->references('id')->on('staff');
        $table->foreign('sclass_id')->references('id')->on('sclasses');
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
