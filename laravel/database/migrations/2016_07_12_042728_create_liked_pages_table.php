<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLikedPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('liked_pages', function (Blueprint $table) {
			 $table->increments('id');
             $table->string('page_id');
			 $table->string('name');
			 $table->timestamps();

			 $table->integer('social_media_id')->unsigned();
			 $table->foreign('social_media_id')->references('id')->on('social_media');
		 });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('liked_pages');
    }
}
