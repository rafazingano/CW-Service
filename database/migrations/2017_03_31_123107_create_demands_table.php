<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDemandsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('demands', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('location_id')->unsigned();
            $table->text('content');
            $table->dateTime('deadline');
            /* 'who': a => all, m => my connections */
            $table->enum('who', ['a', 'm']);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
            $table->foreign('location_id')
                    ->references('id')
                    ->on('locations')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('demands');
    }

}
