<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndvProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indv_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index();
            $table->string('mobile_no');
            $table->string('student_id')->unique()->index();
            $table->integer('student_class')->index();
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
        Schema::drop('indv_profiles');
    }
}
