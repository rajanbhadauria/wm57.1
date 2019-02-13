<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
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
            $table->integer('user_id');
            $table->string('primaryEmail');
            $table->string('altEmail');
            $table->string('primaryPhoneCode');
            $table->string('primaryPhone');
            $table->string('altPhoneCode');
            $table->string('altPhone');
            $table->string('altRelation');
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
        Schema::drop('contacts');
    }
}
