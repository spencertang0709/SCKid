<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('contact');
            $table->boolean('direction');
            $table->boolean('read');
            $table->string('message');
            $table->DateTime('time');
            $table->timestamps();

            $table->integer('kid_id')->unsigned()->nullable();
            $table->foreign('kid_id')->references('id')->on('kids')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sms');
    }
}
