<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUseOfFundColumnToLoanList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loan_lists', function (Blueprint $table) {
            //
            $table->unsignedTinyInteger('use_of_fund')->commit("config/constants.php的USE_OF_FUND");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('loan_lists', function (Blueprint $table) {
            //
        });
    }
}
