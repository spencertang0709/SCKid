<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name');
			$table->string('comments');
			$table->integer('count');
			$table->string('privacy');
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
        Schema::drop('albums');
    }
}
