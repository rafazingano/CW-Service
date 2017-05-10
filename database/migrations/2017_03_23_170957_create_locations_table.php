<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('state_id')->unsigned();
            $table->integer('city_id')->unsigned();
            $table->integer('neighborhood_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('title')->default('Localização');
            $table->string('address')->nullable();
            $table->integer('number')->nullable();
            $table->string('complement')->nullable();
            $table->string('postcode')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('state_id')
                    ->references('id')
                    ->on('states')
                    ->onDelete('cascade');
            $table->foreign('city_id')
                    ->references('id')
                    ->on('cities')
                    ->onDelete('cascade');
            $table->foreign('neighborhood_id')
                    ->references('id')
                    ->on('neighborhoods')
                    ->onDelete('cascade');
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
        });

        /*
        Schema::create('location_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('location_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            $table->foreign('location_id')
                    ->references('id')
                    ->on('locations')
                    ->onDelete('cascade');
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
        });
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //Schema::dropIfExists('location_user');
        Schema::dropIfExists('locations');
    }

}
