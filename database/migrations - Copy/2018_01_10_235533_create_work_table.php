<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work', function (Blueprint $table) {
            $table->increments('id');


            $table->integer('user_id');

            $table->string('company',60);
            $table->string('employementType',60);
            $table->string('employementStatus',60);

            $table->string('city',60);
            $table->string('country',60);

            $table->string('level',60);
            $table->string('designation',60);
            $table->string('department',60);
            $table->string('role',60);
            $table->string('roleDesc',1000);

            $table->string('teamSize',60);

            $table->string('ddStart',3);
            $table->string('mmStart',3);
            $table->string('yyyyStart',5);

            $table->string('ddEnd',3);
            $table->string('mmEnd',3);
            $table->string('yyyyEnd',5);

            $table->timestamp('workStartDate');
            $table->timestamp('workEndDate');


            $table->string('fixSalaryType',60);
            $table->string('fixCurrency',60);
            $table->string('fixSalary',60);
            
            $table->string('variableSalaryType',60);
            $table->string('variableCurrency',60);            
            $table->string('variableSalary',60);

            $table->string('ctc',60);
            

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
        Schema::drop('work');
    }
}
