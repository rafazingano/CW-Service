<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            /***
             * Status y => Ativo
             * Status n => Inativo
             */
            $table->enum('status', ['y', 'n'])->default('n');            
            $table->timestamps();
            $table->softDeletes();
        });
        
        Schema::create('demand_tag', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('demand_id')->unsigned();
            $table->integer('tag_id')->unsigned();
            $table->foreign('demand_id')
                    ->references('id')
                    ->on('demands')
                    ->onDelete('cascade');
            $table->foreign('tag_id')
                    ->references('id')
                    ->on('tags')
                    ->onDelete('cascade');
            $table->timestamps();
        });
        
        Schema::create('tag_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('tag_id')->unsigned();
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
            $table->foreign('tag_id')
                    ->references('id')
                    ->on('tags')
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
        Schema::dropIfExists('tag_user');
        Schema::dropIfExists('demand_tag');
        Schema::dropIfExists('tags');
    }
}
