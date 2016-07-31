<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTitleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_title', function (Blueprint $table) {
            $table->increments('id');

        $table->integer('article_id')->unsigned();
        $table->foreign('article_id')->references('id')->on('articles');

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
      Schema::drop('article_title');
    }
}
