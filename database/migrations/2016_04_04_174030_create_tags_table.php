<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('标签名称');
            $table->string('description')->comment('标签描述');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('content_tag', function (Blueprint $blueprint) {
            $blueprint->integer('content_id')->unsigned()->comment('内容 ID');
            $blueprint->integer('tag_id')->unsigned()->comment('标签 ID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tags');
        Schema::drop('content_tag');
    }
}
