<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGcmkeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gcm_keys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('api_key');
            $table->string('registration_token');
            $table->timestamps();

            $table->integer('device_id')->unsigned();
            $table->foreign('device_id')->references('id')->on('devices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('gcm_keys');
    }
}
