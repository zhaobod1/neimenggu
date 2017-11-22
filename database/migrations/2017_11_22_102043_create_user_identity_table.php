<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserIdentityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_identity', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('id_card_name');
            $table->string('id_card_number');
            $table->string('id_card_pic_front');
            $table->string('id_card_pic_back');
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
        Schema::dropIfExists('user_identity');
    }
}
