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
			$table->string('comments')->nullable();
			$table->integer('likes')->nullable();
			$table->dateTime('post_time')->nullable();
			$table->string('story')->nullable();
			$table->string('location')->nullable();
			$table->integer('latitude')->nullable();
			$table->integer('longitude')->nullable();
            $table->integer('sensitive')->nullable();
			
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
