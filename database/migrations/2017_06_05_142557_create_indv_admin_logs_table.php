<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndvAdminLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indv_admin_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('admin_id')->index();
            $table->integer('action')->index();
            $table->integer('user_id')->nullable()->index();
            $table->string('description')->nullable();
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
        Schema::drop('indv_admin_logs');
    }
}
