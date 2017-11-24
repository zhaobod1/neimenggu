<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyFinanceAboutCompanyInfoDefaultValue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('finance_pros', function (Blueprint $table) {
            //
            $table->string('company_name')->default('')->change();
            $table->string('credential')->default('')->change();
            $table->string('business_license_pic')->default('')->change();
            $table->string('organization_code_pic')->default('')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('finance_pros', function (Blueprint $table) {
            //
        });
    }
}
