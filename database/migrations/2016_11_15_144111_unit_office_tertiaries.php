<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UnitOfficeTertiaries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_office_tertiaries', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('UnitOfficeTertiaryName', 45)->unique();
            $table->string('UnitOfficeHasQuaternary', 45);
            $table->integer('UnitOfficeSecondaryID')->unsigned();
            $table->foreign('UnitOfficeSecondaryID')->references('id')->on('unit_office_secondaries');
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
