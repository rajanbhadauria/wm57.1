<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoftskills extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('softskills', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->text('soft_skill');
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
        Schema::dropIfExists('softskills');
    }
}
