<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
   
    public function up()
    {
        Schema::create('users', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->string('name');
            $table->tinyInteger('status');
            $table->tinyInteger('admintype')->nullable();
            $table->string('email')->unique();
            $table->string('password', 60);

            $table->integer('unit_id')->unsigned()->nullable()->references('id')->on('unit_offices');
            $table->integer('second_id')->unsigned()->nullable()->references('id')->on('unit_office_secondaries');
            $table->integer('tertiary_id')->unsigned()->nullable()->references('id')->on('unit_office_tertiaries');
            $table->integer('quaternary_id')->unsigned()->nullable()->references('id')->on('unit_office_quaternaries');

            $table->rememberToken();
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
        Schema::drop('users');
    }
}
