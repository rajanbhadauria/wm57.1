<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResumesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resumes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ownerEmail',160);
            $table->string('userEmail',160);
            $table->enum('currentAddressData', ['0', '1'])->default('0')->comment('0: No; 1: Yes');
            $table->enum('permanentAddressData', ['0', '1'])->default('0')->comment('0: No; 1: Yes');
            $table->enum('awardData', ['0', '1'])->default('0')->comment('0: No; 1: Yes');
            $table->enum('certificationData', ['0', '1'])->default('0')->comment('0: No; 1: Yes');
            $table->enum('contactData', ['0', '1'])->default('0')->comment('0: No; 1: Yes');
            $table->enum('courseData', ['0', '1'])->default('0')->comment('0: No; 1: Yes');
            $table->enum('educationData', ['0', '1'])->default('0')->comment('0: No; 1: Yes');
            $table->enum('languageData', ['0', '1'])->default('0')->comment('0: No; 1: Yes');
            $table->enum('objectiveData', ['0', '1'])->default('0')->comment('0: No; 1: Yes');
            $table->enum('patentData', ['0', '1'])->default('0')->comment('0: No; 1: Yes');
            $table->enum('profileData', ['0', '1'])->default('0')->comment('0: No; 1: Yes');
            $table->enum('projectData', ['0', '1'])->default('0')->comment('0: No; 1: Yes');
            $table->enum('referenceData', ['0', '1'])->default('0')->comment('0: No; 1: Yes');
            $table->enum('skillData', ['0', '1'])->default('0')->comment('0: No; 1: Yes');
            $table->enum('trainingData', ['0', '1'])->default('0')->comment('0: No; 1: Yes');
            $table->enum('travelData', ['0', '1'])->default('0')->comment('0: No; 1: Yes');
            $table->enum('workData', ['0', '1'])->default('0')->comment('0: No; 1: Yes');
            $table->enum('status', ['0', '1'])->default('0')->comment('0: No; 1: Yes');

            $table->string("subject");
            $table->longText("coverLetter");

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
        Schema::drop('resumes');
    }
}
