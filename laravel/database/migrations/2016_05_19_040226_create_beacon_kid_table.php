<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeaconKidTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('beacon_kid', function (Blueprint $table) {
			$table->increments('id');
			
			$table->integer('beacon_id')->unsigned();
			$table->foreign('beacon_id')->references('id')->on('beacons');
			
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
        Schema::drop('beacon_kid');
    }
}
