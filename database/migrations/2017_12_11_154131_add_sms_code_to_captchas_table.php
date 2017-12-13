<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSmsCodeToCaptchasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('captchas', function (Blueprint $table) {
            $table->string('sms_code')->nullable();
            $table->boolean('sms_checked')->default(false)->commit('sms验证码是否正确');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('captchas', function (Blueprint $table) {

        });
    }
}
