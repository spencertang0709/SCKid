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
			$table->string('post_id');
			$table->string('message');
			$table->string('story');
			$table->string('comments');
			$table->integer('likes');
			$table->string('latitude');
			$table->string('longitude');
			$table->string('location');
			$table->string('post_time');
			
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
