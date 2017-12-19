<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinanceProsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance_pros', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');

            $table->boolean('is_company');
            $table->string('company_name')->nullable();
            $table->string('credential')->nullable();
            $table->string('business_license_pic')->nullable();
            $table->string('business_license_pic_text')->nullable();
            $table->string('organization_code_pic')->nullable();
            $table->string('organization_code_pic_text')->nullable();

            $table->string('id_card')->nullable();
            $table->string('id_card_pic_front')->nullable();
            $table->text('id_card_pic_front_txt')->nullable();
            $table->string('id_card_pic_back')->nullable();
            $table->text('id_card_pic_back_txt')->nullable();
            $table->string('id_card_pic_hold')->nullable();
            $table->text('id_card_pic_hold_txt')->nullable();

            $table->string('bank_card')->nullable();
            $table->tinyInteger('bank_name')->nullable();
            $table->string('bank_location')->nullable();
            $table->string('bank_phone')->nullable();

            $table->string('mobile_phone')->nullable();

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
        Schema::dropIfExists('finance_pros');
    }
}
