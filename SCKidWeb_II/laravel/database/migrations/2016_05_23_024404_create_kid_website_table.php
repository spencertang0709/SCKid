<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKidWebsiteTable extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kid_website', function (Blueprint $table) {
			$table->increments('id');
			$table->boolean('is_blocked');
			$table->boolean('is_monitored');
			
			$table->integer('website_id')->unsigned();
			$table->foreign('website_id')->references('id')->on('websites');
			
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
        Schema::drop('kid_website');
    }
}
