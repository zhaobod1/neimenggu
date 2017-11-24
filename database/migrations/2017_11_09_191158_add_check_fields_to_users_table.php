<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCheckFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

            //身份认证
	        $table->tinyInteger('status_identity_auth')->defalut(config('constants.ADMIN_MODULE.NOT_FILLED'));
	        //个人信息
	        $table->tinyInteger('status_profile_auth')->defalut(config('constants.ADMIN_MODULE.NOT_FILLED'));
			//收款信息认证
	        $table->tinyInteger('status_bank_auth')->defalut(config('constants.ADMIN_MODULE.NOT_FILLED'));

	        //手机认证
	        $table->tinyInteger('status_mobile_phone_auth')->defalut(config('constants.ADMIN_MODULE.NOT_FILLED'));

	        //企业资质认证
	        $table->tinyInteger('status_company_auth')->defalut(config('constants.ADMIN_MODULE.NOT_FILLED'))->commit("企业认证状态，状态有4个，在config/constants.php内");


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
