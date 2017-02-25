<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulePersonalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_personal', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('schedule_id')->unsigned()->index();
            $table->integer('personal_id')->unsigned()->index();
            $table->foreign('schedule_id')->references('id')
                ->on('schedule')->onDelete('cascade');
            $table->foreign('personal_id')->references('id')
                ->on('personal')->onDelete('cascade');;
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
        Schema::dropIfExists('schedule_personal');
    }
}
