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
            $table->dateTime('start_time');
            $table->dateTime('end_time');
			$table->string('guardianNearby');
			/*
            $table->string('longitude');
            $table->string('latitude');
            $table->string('beacon');
			*/
        
			
			$table->integer('beacon_id')->unsigned();
            $table->foreign('beacon_id')->references('id')->on('beacons');

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
