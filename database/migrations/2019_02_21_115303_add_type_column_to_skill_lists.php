<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeColumnToSkillLists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('skill_lists', function (Blueprint $table) {
            $table->enum('skill_type', ['soft', 'functional'])->default('functional')->comment('functional: Functional Domain Skills; soft: Soft management skill;');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('skill_lists', function (Blueprint $table) {
            $table->dropColumn('skill_type');
        });
    }
}
