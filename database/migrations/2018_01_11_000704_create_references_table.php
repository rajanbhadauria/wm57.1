<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('references', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id');
            $table->string('reference',60);
            $table->string('school',60);
            $table->string('role',60);
            $table->string('remarks',60);            
            $table->string('phone',60);
            $table->string('email',60);
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
        Schema::drop('references');
    }
}
