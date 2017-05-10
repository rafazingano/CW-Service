<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('demand_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('file');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('demand_id')
                    ->references('id')
                    ->on('demands')
                    ->onDelete('cascade');
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
    public function down() {
        Schema::dropIfExists('files');
    }

}
