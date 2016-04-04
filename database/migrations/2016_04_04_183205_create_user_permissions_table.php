<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique()->comment('权限名');
            $table->string('display_name')->comment('权限展示名称');
            $table->text('description')->comment('权限描述');
            $table->timestamps();
        });

        Schema::create('user_permission_user_role', function (Blueprint $blueprint) {
            $blueprint->integer('permission_id')->unsigned()->comment('用户权限 ID');
            $blueprint->integer('role_id')->unsigned()->comment('用户角色 ID');
            $blueprint->primary(['permission_id', 'role_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_permissions');
        Schema::drop('user_permission_user_role');
    }
}
