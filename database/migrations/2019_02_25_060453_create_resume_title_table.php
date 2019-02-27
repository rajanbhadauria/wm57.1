<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResumeTitleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resume_titles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string("resume_title",1000);
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
        Schema::dropIfExists('resume_titles');
    }
}
