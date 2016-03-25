<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('account_id')->unsigned()->comment('账户 ID');
            $table->string('account_type')->comment('账户类型');

            $table->string('name')->unique()->nullable()->comment('内容名称');
            $table->string('model_type')->index()->comment('内容数据类型');
            $table->integer('model_id')->unsigned()->index()->comment('内容数据 ID');
            $table->integer('category_id')->unsigned()->default(0)->comment('分类 ID');

            $table->string('title')->index()->comment('标题');
            $table->string('keywords')->nullable()->comment('关键字');
            $table->text('description')->comment('描述和摘要');

            $table->boolean('status')->default(1)->comment('内容状态');
            $table->boolean('display')->default(true)->comment('内容是否可见');
            $table->softDeletes();
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
        Schema::drop('contents');
    }
}
