<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppKidTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_kid', function (Blueprint $table) {
			$table->increments('id');
			$table->boolean('is_blocked');
			$table->boolean('is_monitored');
			$table->boolean('is_installed');
			
			$table->integer('app_id')->unsigned();
			$table->foreign('app_id')->references('id')->on('apps');
			
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
        Schema::drop('app_kid');
    }
}
