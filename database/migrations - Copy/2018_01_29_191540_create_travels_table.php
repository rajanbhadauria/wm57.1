<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTravelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travels', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');

            $table->string('project',60);
            
            $table->string('projectDesc',255);
            $table->string('company',60);
            $table->string('ddStart',3);
            $table->string('mmStart',3);
            $table->string('yyyyStart',5);

            $table->string('ddEnd',3);
            $table->string('mmEnd',3);
            $table->string('yyyyEnd',5);

            $table->timestamp('projectStartDate');
            $table->timestamp('projectEndDate');

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
        Schema::drop('travels');
    }
}
