<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('demand_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->enum('approved', ['y', 'n'])->nullable();            
            $table->text('content');
            $table->foreign('demand_id')
                    ->references('id')
                    ->on('demands')
                    ->onDelete('cascade');
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('contacts');
    }

}
