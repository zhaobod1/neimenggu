<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePunishRelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('punishments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('problem_desc')->nullable()->commit('问题描述');
            $table->integer('direct_admin_id')->nullable()->commit('直接负责人ID');
            $table->float('direct_punish_price')->nullable()->commit('直接负责人处罚金额');
            $table->integer('indirect_admin_id')->nullable()->commit('间接责任人ID');
            $table->float('indirect_punish_price')->nullable()->commit('间接负责人处罚金额');
            $table->string('other_punishment')->nullable()->commit('其他问责');
            $table->integer('department_id')->nullable()->commit('检查部门ID');
            $table->string('punish_refer_num')->nullable()->commit('处罚文号');
            $table->string('organization')->nullable()->commit('机构');
            $table->integer('type_of_business')->default(0)->commit('业务种类');
            $table->integer('check_project_name')->default(0)->commit('检查项目名称');
            $table->integer('defense_line')->default(0)->commit('防线');
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
        Schema::dropIfExists('punishments');
    }
}
