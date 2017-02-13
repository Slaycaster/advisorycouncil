<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Lecturer extends Migration
{
    public function up()
    {
        Schema::create('Lecturer', function(Blueprint $table)
        {
            $table->increments('ID');
            $table->text('lecturername');
            $table->integer('training_id')->unsigned();
            $table->foreign('training_id')->references('ID')->on('Training');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('Lecturer');
    }
}
