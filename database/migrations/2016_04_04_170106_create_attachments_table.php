<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('token', 52)->unique()->comment('文件 TOKEN');
            $table->string('driver')->default('local')->comment('文件驱动');
            $table->string('path')->nullable()->index()->comment('存储路径');
            $table->string('full_path')->nullable()->index()->comment('完整的存储路径');
            $table->string('visit_path')->nullable()->index()->comment('访问路径，可为一个 URL，用于访问文件');
            $table->string('filename')->nullable()->index()->comment('文件名');
            $table->string('extension_name')->nullable()->comment('扩展名');
            $table->string('mime')->comment('媒体类型');
            $table->integer('size')->comment('文件大小');
            $table->string('origin_filename')->nullable()->index()->comment('原始文件名');
            $table->char('md5', 32)->index()->comment('文件的 MD5 值');
            $table->string('sha512', 128)->index()->comment('文件的 SHA-512 值');

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
        Schema::drop('attachments');
    }
}
