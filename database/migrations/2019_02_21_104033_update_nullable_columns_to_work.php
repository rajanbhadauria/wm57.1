<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateNullableColumnsToWork extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function __construct()
    {
        DB::getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
    }
    public function up()
    {
        Schema::table('work', function (Blueprint $table) {
            $table->string('level',60)->nullable()->change();
            $table->string('department',60)->nullable()->change();
            $table->string('role',60)->nullable()->change();
            $table->string('roleDesc',1000)->nullable()->change();
            $table->string('teamSize',60)->nullable()->change();
            $table->string('ddStart',3)->nullable()->change();
            $table->string('ddEnd',3)->nullable()->change();
            $table->string('mmEnd',3)->nullable()->change();
            $table->string('yyyyEnd',5)->nullable()->change();
            $table->string('fixSalaryType',60)->nullable()->change();
            $table->string('fixCurrency',60)->nullable()->change();
            $table->string('fixSalary',60)->nullable()->change();
            $table->string('variableSalaryType',60)->nullable()->change();
            $table->string('variableCurrency',60)->nullable()->change();
            $table->string('variableSalary',60)->nullable()->change();
            $table->string('ctc',60)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('work', function (Blueprint $table) {
            $table->string('level',60)->nullable(false)->change();
            $table->string('department',60)->nullable(false)->change();
            $table->string('role',60)->nullable(false)->change();
            $table->string('roleDesc',1000)->nullable(false)->change();
            $table->string('teamSize',60)->nullable(false)->change();
            $table->string('ddStart',3)->nullable(false)->change();
            $table->string('ddEnd',3)->nullable(false)->change();
            $table->string('mmEnd',3)->nullable(false)->change();
            $table->string('yyyyEnd',5)->nullable(false)->change();
            $table->string('fixSalaryType',60)->nullable(false)->change();
            $table->string('fixCurrency',60)->nullable(false)->change();
            $table->string('fixSalary',60)->nullable(false)->change();
            $table->string('variableSalaryType',60)->nullable(false)->change();
            $table->string('variableCurrency',60)->nullable(false)->change();
            $table->string('variableSalary',60)->nullable(false)->change();
            $table->string('ctc',60)->nullable(false)->change();
        });
    }
}
