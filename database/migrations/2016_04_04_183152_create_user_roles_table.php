<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique()->comment('角色名');
            $table->string('display_name')->comment('角色展示名称');
            $table->text('description')->comment('角色描述');
            $table->timestamps();
        });

        Schema::create('user_user_role', function (Blueprint $blueprint) {
            $blueprint->integer('user_id')->unsigned()->comment('用户 ID');
            $blueprint->integer('user_role_id')->unsigned()->comment('用户角色 ID');
            $blueprint->primary(['user_id', 'user_role_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_roles');
        Schema::drop('user_user_role');
    }
}
