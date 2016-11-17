<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ACCategory extends Migration
{
    public function up()
    {
        Schema::create('ACCategory', function(Blueprint $table)
        {
            $table->increments('ID');
            $table->string('categoryname', 45);
        });
    }

    public function down()
    {
        Schema::drop('ACCategory');
    }
}