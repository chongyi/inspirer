<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique()->nullable()->comment('用户名称');
            $table->string('email')->unique()->comment('用户邮箱');
            $table->char('password', 60)->comment('密码');
            $table->timestamp('last_login_time')->comment('最后登录时间');
            $table->integer('login_times')->comment('登录次数')->default(0);
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
        Schema::drop('users');
    }
}
