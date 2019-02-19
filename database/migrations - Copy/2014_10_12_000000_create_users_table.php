<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('google_id');
            $table->string('avatar');
            $table->timestamp('avatar_updated')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->enum('profilePrivate', ['0', '1'])->default('0')->comment('1: No; 0: Yes');
            $table->string('password');
            $table->enum('role', ['1', '2', '3'])->default('1')->comment('1: Admin; 2: Manager; 3:subscriber');
            $table->enum('status', ['0', '1'])->default('1')->comment('1: Active; 0: Not Active');
            $table->text('activate_token');
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
