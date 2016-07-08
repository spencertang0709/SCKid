<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKidSocialMediaTable extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kid_social_media', function (Blueprint $table) {
			$table->increments('id');
			$table->boolean('is_blocked');
			$table->boolean('is_monitored');
            $table->string('token');
			
			$table->integer('social_media_id')->unsigned();
			$table->foreign('social_media_id')->references('id')->on('social_media');
			
			$table->integer('kid_id')->unsigned();
			$table->foreign('kid_id')->references('id')->on('kids')->onDelete('cascade');

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
        Schema::drop('kid_social_media');
    }
}
