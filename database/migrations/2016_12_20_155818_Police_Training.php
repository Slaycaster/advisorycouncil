<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PoliceTraining extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Police_Training', function(Blueprint $table)
        {
            $table->primary(array('police_id', 'police_training_id'));
            $table->integer('police_id')->unsigned();
            $table->integer('police_training_id')->unsigned();
            $table->foreign('police_id')->references('ID')->on('Police_Advisory');
            $table->foreign('police_training_id')->references('ID')->on('Training');
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
