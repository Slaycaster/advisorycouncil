<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ACTraining extends Migration
{
    public function up()
    {
        Schema::create('AC_Training', function(Blueprint $table)
        {
            $table->primary(array('id_advisory', 'id_training'));
            $table->integer('id_advisory')->unsigned();
            $table->integer('id_training')->unsigned();
            $table->foreign('id_advisory')->references('ID')->on('Advisory_Council');
            $table->foreign('id_training')->references('ID')->on('Training');
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
