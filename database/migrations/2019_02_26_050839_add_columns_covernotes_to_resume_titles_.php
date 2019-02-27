<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsCovernotesToResumeTitles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('resume_titles', function (Blueprint $table) {
            $table->string('resume_message')->nullable();
            $table->string('thanks_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('resume_titles_', function (Blueprint $table) {
            $table->dropColumn('resume_message');
            $table->dropColumn('thanks_note');
        });
    }
}
