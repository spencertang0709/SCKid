<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
			$table->string('message');
			$table->string('comments');
			$table->integer('likes');
			$table->dateTime('post_time');
			$table->string('story');
			$table->string('location');
			$table->integer('latitude');
			$table->integer('longitude');
			
			$table->integer('social_media_id')->unsigned();
            $table->foreign('social_media_id')->references('id')->on('social_media');

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
        Schema::drop('posts');
    }
}
