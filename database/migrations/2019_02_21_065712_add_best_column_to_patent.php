<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBestColumnToPatent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patent', function (Blueprint $table) {
            $table->enum('best', ['0', '1'])->default('0')->comment('0: Not a Key Achievement; 1: Is a Key Achievement;');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patent', function (Blueprint $table) {
            $table->dropColumn('best');
        });
    }
}
