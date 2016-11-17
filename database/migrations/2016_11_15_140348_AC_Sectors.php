<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ACSectors extends Migration
{
    public function up()
    {
        Schema::create('ACSectors', function(Blueprint $table)
        {
            $table->increments('ID');
            $table->string('sectorname', 45);
        });
    }

    public function down()
    {
        Schema::drop('ACSectors');
    }
}