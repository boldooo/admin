<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategory extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('picture');
            $table->string('key_name');
            $table->text('content');
            $table->string('link');
            $table->integer('parent_id');
            $table->integer('level');
            $table->integer('lang_id')->unsigned()->nullable();

            $table->foreign('lang_id')->references('id')->on('lang')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }

}
