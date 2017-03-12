<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assists', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('entry')->nullable();
            $table->decimal('discount_entry')->default(0);
            $table->dateTime('exit')->nullable();
            $table->decimal('discount_exit')->default(0);
            $table->boolean('justify')->default(0);
            $table->integer('personal_id')->unsigned();
            $table->foreign('personal_id')
                ->references('id')
                ->on('personal')
                ->onDelete('cascade');

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
        Schema::dropIfExists('assists');
    }
}
