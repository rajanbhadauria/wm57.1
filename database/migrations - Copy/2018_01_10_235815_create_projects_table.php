<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id');

            $table->string('project',60);
            $table->string('school',60);
            $table->string('projectDesc',255)->nullable();
            $table->string('url',60)->nullable();
            $table->string('dd',3);
            $table->string('mm',3);
            $table->string('yyyy',5);
            $table->timestamp('projectDate');
            $table->string('city',60)->nullable();
            $table->string('country',60)->nullable();

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
        Schema::drop('projects');
    }
}
