<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PoliceOfficeSecond extends Migration
{
   
    public function up()
    {
        Schema::create('PoliceOfficeSecond', function(Blueprint $table)
        {
            $table->increments('ID');
            $table->string('officename', 45)->unique();
            $table->string('street', 45);
            $table->string('barangay', 45);
            $table->string('city', 45);
            $table->string('province', 45);
            $table->string('contactno', 45);
            $table->string('policeofficecode2', 10)->unique();
            $table->string('desc', 60)->nullable();
            $table->softDeletes();
            $table->integer('police_office_id')->unsigned();
            $table->foreign('police_office_id')->references('ID')->on('PoliceOffices');

        });
    }

    public function down()
    {
        Schema::drop('PoliceOfficeSecond');
    }
}
