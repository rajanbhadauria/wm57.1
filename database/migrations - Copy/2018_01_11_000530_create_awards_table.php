<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('awards', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id');
            $table->string('award',60);
            $table->string('school',60);
            $table->string('dd',3);
            $table->string('mm',3);
            $table->string('yyyy',5);
            $table->timestamp('awardDate');
            $table->string('city',60);
            $table->string('country',60);

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
        Schema::drop('awards');
    }
}
