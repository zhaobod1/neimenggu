<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdCardInfoToFinancePros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('finance_pros', function (Blueprint $table) {

            $table->renameColumn('id_card', 'id_card_num');
            $table->string('id_card_name')->nullable();
            $table->string('id_card_pic_hold')->nullable();
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
