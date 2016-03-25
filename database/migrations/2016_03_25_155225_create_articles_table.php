<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');

            $table->string('author')->nullable()->comment('作者名');

            $table->mediumText('content')->comment('文章内容');
            $table->string('cover', 52)->nullable()->comment('文章封面');
            $table->string('source')->nullable()->comment('文章来源链接，空表示来自本站');
            $table->string('source_name')->nullable()->comment('文章来源名称');

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
        Schema::drop('articles');
    }
}
