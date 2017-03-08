<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UnitOfficeSecondaries extends Migration
{
   
    public function up()
    {
        Schema::create('unit_office_secondaries', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('UnitOfficeSecondaryName', 45)->unique();
            $table->string('UnitOfficeHasTertiary', 45);
            $table->integer('UnitOfficeID')->unsigned();
            $table->foreign('UnitOfficeID')->references('id')->on('unit_offices');
            $table->string('desc', 60)->nullable();
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::drop('unit_office_secondaries');
    }

}
