<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTitleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_title', function (Blueprint $table) {
            $table->increments('id');

        $table->integer('category_id')->unsigned();
        $table->foreign('category_id')->references('id')->on('categories');

        $table->integer('title_id')->unsigned();
        $table->foreign('title_id')->references('id')->on('titles')->onDelete('cascade');

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
        Schema::drop('category_title');
    }
}
