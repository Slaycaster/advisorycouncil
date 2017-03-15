<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Training extends Migration
{
    public function up()
    {
        Schema::create('Training', function(Blueprint $table)
        {
            $table->increments('ID');
            $table->string('trainingname', 100);
            $table->date('startdate')->nullable();
            $table->date('enddate')->nullable();
            $table->string('location', 100)->nullable();
            $table->string('organizer', 45)->nullable();
            $table->time('starttime')->nullable();
            $table->time('endtime')->nullable();
            $table->string('trainingtype', 45)->nullable();
            $table->integer('police_id')->unsigned()->nullable();
            $table->foreign('police_id')->references('ID')->on('Police_Advisory');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('Training');
    }
}
