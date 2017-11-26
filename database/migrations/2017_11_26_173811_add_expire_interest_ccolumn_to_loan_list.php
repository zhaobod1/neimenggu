<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExpireInterestCcolumnToLoanList extends Migration
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
            $table->unsignedInteger('expire_interest')->nullable()->commit('逾期利息');
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
