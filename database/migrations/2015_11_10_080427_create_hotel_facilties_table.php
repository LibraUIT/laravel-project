<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelFaciltiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('hotel_facilties', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->text('icon');
            $table->text('big_heading');
            $table->text('small_heading');
            $table->text('description');
            $table->string('start');
            $table->string('end');
            $table->integer('charge');
            $table->boolean('status');
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
        //
        Schema::dropIfExists('hotel_facilties');
    }
}
