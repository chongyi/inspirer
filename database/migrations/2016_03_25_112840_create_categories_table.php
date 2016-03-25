<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('parent_id')->unsgined()->default(0)->comment('父分类 ID');
            $table->string('name')->unique()->nullable()->comment('分类名称');
            $table->string('model_type')->index()->nullable()->comment('内容数据类型');
            $table->integer('model_id')->unsigned()->index()->nullable()->comment('内容数据 ID');

            $table->string('title')->index()->comment('分类标题');
            $table->string('keywords')->nullable()->comment('分类关键字');
            $table->string('description')->comment('描述或摘要');

            $table->boolean('status')->default(1)->comment('状态');
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
        Schema::drop('categories');
    }
}
