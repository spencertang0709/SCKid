<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContextPolicysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('context_policys', function (Blueprint $table) {
            $table->increments('id');
			$table->string('app_list');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
			$table->boolean('screen_time');

			$table->integer('beacon_id')->unsigned();
            $table->foreign('beacon_id')->references('id')->on('beacons')->onDelete('cascade');

			$table->integer('kid_id')->unsigned();
            $table->foreign('kid_id')->references('id')->on('kids');

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
        Schema::drop('context_policys');
    }
}
