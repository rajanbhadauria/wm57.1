<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id');
            $table->string('language',60);
           $table->enum('read', ['0', '1'])->default('0')->comment('0: No; 1: Yes');
           $table->enum('write', ['0', '1'])->default('0')->comment('0: No; 1: Yes');
           $table->enum('speak', ['0', '1'])->default('0')->comment('0: No; 1: Yes');

            $table->enum('private', ['0', '1'])->default('0')->comment('1: No; 0: Yes');

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
        Schema::drop('languages');
    }
}
