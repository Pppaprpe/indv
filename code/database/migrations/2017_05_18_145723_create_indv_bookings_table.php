<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndvBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indv_bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->date('startdate')->index();
            $table->date('enddate')->index();
            $table->integer('user_id')->index();
            $table->integer('booking_period');
            $table->integer('booking_sort');
            $table->integer('booking_status');
            $table->integer('syllabus')->nullable();
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
        Schema::drop('indv_bookings');
    }
}
