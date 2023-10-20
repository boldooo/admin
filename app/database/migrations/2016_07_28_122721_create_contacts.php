<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContacts extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('facebook');
            $table->string('twitter');
            $table->string('youtube');
            $table->string('phone');
            $table->string('email');
            $table->string('website');
            $table->text('address');
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
