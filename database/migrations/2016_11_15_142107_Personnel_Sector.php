<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PersonnelSector extends Migration
{
    public function up()
    {
        Schema::create('Personnel_Sector', function(Blueprint $table)
        {
            $table->increments('ID');
            $table->integer('advisory_council_id')->unsigned();
            $table->integer('ac_sector_id')->unsigned();
           
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::drop('Personnel_Sector');
    }
}
