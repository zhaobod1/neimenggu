<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDistrictColumnToUserAddrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_addr', function (Blueprint $table) {
            //
            $table->integer('district')->nullable();
            $table->string('district')->nullable();
            $table->string('city_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_addr', function (Blueprint $table) {
            //
        });
    }
}
