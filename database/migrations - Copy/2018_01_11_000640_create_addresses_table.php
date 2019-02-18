<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('houseNumber',20);
            $table->string('blockSector',50);
            $table->string('societyName',100);
            $table->string('landmark',100);
            $table->string('area',100);
            $table->string('pincode',10);
            $table->string('city',50);
            $table->string('state',50);
            $table->string('country',50);            
            $table->enum('type', ['0', '1'])->default('0')->comment('1: permanent; 0: current');
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
        Schema::drop('addresses');
    }
}
