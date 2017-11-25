<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLoanRecordsColumnToLoanList extends Migration
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
            $table->unsignedInteger('interest')->nullable()->commit('贷款利息');
            $table->unsignedInteger('period')->nullable()->commit('贷款周期');
            $table->unsignedTinyInteger('loan_status')->default('1')->commit('贷款状态，详见config/constants.php，默认1，待审核');
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
