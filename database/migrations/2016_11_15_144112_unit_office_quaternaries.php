<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UnitOfficeQuaternaries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_office_quaternaries', function(Blueprint $table)
        {
            $table->increments('id')->unsigned();
            $table->string('UnitOfficeQuaternaryName', 45)->unique();
            $table->integer('UnitOfficeTertiaryID')->unsigned();
            $table->foreign('UnitOfficeTertiaryID')->references('id')->on('unit_office_tertiaries');
            $table->string('desc', 60)->nullable();
            $table->timestamps();

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
