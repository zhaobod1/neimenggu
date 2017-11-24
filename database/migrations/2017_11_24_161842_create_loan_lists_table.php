<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoanListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_lists', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedSmallInteger('type')->commit("详见config/constants.php下面的loan_type.");
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('admin_id');
            $table->unsignedInteger('loan_price');
            $table->unsignedTinyInteger('level_income')->commit("config/constants.php的INCOME_LEVEL");
            $table->string('note')->nullable();
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
        Schema::dropIfExists('loan_lists');
    }
}
