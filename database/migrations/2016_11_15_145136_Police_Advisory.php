<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PoliceAdvisory extends Migration
{
    public function up()
    {
        Schema::create('Police_Advisory', function(Blueprint $table)
        {
            $table->increments('ID');
            $table->string('fname', 45);
            $table->string('mname', 45)->nullable();
            $table->string('lname', 45);
            $table->string('qualifier', 45)->nullable();
            $table->tinyInteger('gender');
            $table->string('contactno', 15);
            $table->string('email', 30);
            $table->string('street', 50)->nullable();
            $table->string('city', 45)->nullable();
            $table->string('barangay', 45)->nullable();
            $table->string('province', 45)->nullable();
            $table->tinyInteger('policetype');
            $table->string('authorityorder', 20)->unique();
            $table->text('imagepath')->nullable();
            $table->date('startdate');
            $table->date('enddate')->nullable();
            $table->string('fbuser', 20)->nullable();
            $table->string('twitteruser', 20)->nullable();
            $table->string('iguser', 20)->nullable();
            $table->integer('rank_id')->unsigned();
            $table->foreign('rank_id')->references('id')->on('ranks');
            $table->integer('police_position_id')->unsigned();
            $table->integer('unit_id')->unsigned();
            $table->integer('second_id')->unsigned();
            $table->integer('tertiary_id')->unsigned();
            $table->integer('quaternary_id')->unsigned();
            $table->foreign('police_position_id')->references('id')->on('Police_Position');
            $table->foreign('unit_id')->references('id')->on('unit_offices');
            $table->foreign('second_id')->references('id')->on('unit_office_secondaries');
            $table->foreign('tertiary_id')->references('id')->on('unit_office_tertiaries');
            $table->foreign('quaternary_id')->references('id')->on('unit_office_quaternaries');
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::drop('Police_Advisory');
    }
}
