<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patent', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id');
            $table->string('patent',60);
            $table->string('reference',60);
            $table->string('status',60);

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
        Schema::drop('patent');
    }
}
