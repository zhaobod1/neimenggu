<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBaseInfoToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //个人信息
			$table->tinyInteger('sex')->nullable();
			$table->unsignedInteger('age')->nullable();
			$table->timestamp('birth')->nullable();
			$table->unsignedInteger('country')->nullable();
			$table->unsignedInteger('province')->nullable();
			$table->unsignedInteger('city')->nullable();
			$table->unsignedInteger('county')->nullable();
			$table->string('address')->nullable();
			$table->string('education')->nullable();
			$table->string('college')->nullable();
			//身份认证
			$table->string('id_card')->nullable();
			$table->string('id_card_pic_front')->nullable();
			$table->string('id_card_pic_back')->nullable();
			//收款信息
	        $table->string('bank_card')->nullable();
	        $table->string('bank_name')->nullable();
	        $table->string('bank_location')->nullable();
	        $table->string('bank_phone')->nullable();

	        //手机认证
	        $table->string('mobile_phone')->nullable();







        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
