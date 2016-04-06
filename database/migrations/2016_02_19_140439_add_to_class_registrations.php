<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddToClassRegistrations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::table('scout_registrations', function(Blueprint $table) {
          $table->string('block1_pm')->nullable();
          $table->string('block2_pm')->nullable();
          $table->string('block3_pm')->nullable();
          $table->string('block4_pm')->nullable();
          $table->string('block5_pm')->nullable();
          $table->string('block6_pm')->nullable();
          $table->string('block1_twilight')->nullable();
          $table->string('block2_twilight')->nullable();
          $table->string('block3_twilight')->nullable();
          $table->string('block4_twilight')->nullable();
          $table->string('block5_twilight')->nullable();
          $table->string('block6_twilight')->nullable();
        });*/
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
