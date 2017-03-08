<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdvisoryCouncil extends Migration
{
    public function up()
{

    Schema::create('Advisory_Council', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('ID');
            $table->string('fname', 45);
            $table->string('mname', 45)->nullable();
            $table->string('lname', 45);
            $table->string('qualifier', 45)->nullable();
            $table->tinyInteger('gender');
            $table->string('contactno', 15)->nullable();
            $table->string('landline', 15)->nullable();
            $table->string('officename', 45)->nullable();
            $table->string('officeaddress', 45)->nullable();
            $table->string('email', 30)->nullable();
            $table->string('street', 50)->nullable();
            $table->string('city', 45)->nullable();
            $table->string('barangay', 45)->nullable();
            $table->string('province', 45)->nullable();
            $table->date('startdate');
            $table->date('enddate')->nullable();
            $table->string('fbuser', 20)->nullable();
            $table->string('twitteruser', 20)->nullable();
            $table->string('iguser', 20)->nullable();
            $table->date('birthdate');
            $table->text('imagepath')->nullable();
            $table->integer('advisory_position_id')->unsigned();
            //$table->integer('subcategoryId')->unsigned();
            $table->integer('ac_sector_id')->unsigned();


            $table->integer('unit_id')->unsigned();
            $table->integer('second_id')->unsigned();
            $table->integer('tertiary_id')->unsigned();
            $table->integer('quaternary_id')->unsigned();


            $table->foreign('ac_sector_id')->references('ID')->on('AC_Sector');
            $table->foreign('advisory_position_id')->references('ID')->on('Advisory_Position');
            //$table->foreign('subcategoryId')->references('ID')->on('AC_Subcategory');

            $table->timestamps();

        });
}

    public function down()
    {
        Schema::drop('Advisory_Council');
    }
}
