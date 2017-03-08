<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ACSubcategory extends Migration
{
    public function up()
    {
        Schema::create('AC_Subcategory', function(Blueprint $table)
        {
            $table->increments('ID');
            $table->string('subcategoryname', 45)->unique();
            $table->string('desc', 60)->nullable();
             $table->integer('category_id')->unsigned();


            $table->foreign('category_id','fk_category_id')->references('ID')->on('AC_Category');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::drop('AC_Subcategory');
    }
}
