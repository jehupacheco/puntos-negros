<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlackPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('black_points', function (Blueprint $table) {
            $table->increments('id');
            $table->string('latitude');
            $table->string('longitude');
            $table->integer('city_id')->unsigned();
            $table->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->onDelete('cascade');
            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')
                ->references('id')
                ->on('status')
                ->onDelete('cascade');
            $table->timestamps();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('black_points');
    }
}
