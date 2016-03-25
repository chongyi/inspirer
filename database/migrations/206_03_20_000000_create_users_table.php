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

            $table->string('nickname')->nullable()->comment('用户昵称');
            $table->string('email')->unique()->comment('用户邮箱');
            $table->string('password', 60)->nullable()->comment('密码');

            $table->timestamp('last_login_time')->comment('最后登录时间');
            $table->integer('login_times')->comment('登录次数')->default(0);

            $table->boolean('status')->default(1)->comment('用户状态');

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
