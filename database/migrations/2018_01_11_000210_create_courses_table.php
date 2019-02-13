<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id');
            $table->string('course',60);
            $table->string('school',60);

            $table->string('grade',30);
            $table->string('gradeValue',30);

            $table->string('dd',3);
            $table->string('mm',3);
            $table->string('yyyy',5);
            $table->timestamp('courseDate');
            

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
        Schema::drop('courses');
    }
}
