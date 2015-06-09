<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('articles', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->string('title');
			$table->string('name')->nullable();
			$table->integer('category_id');
			$table->string('keywords');
			$table->text('description');
			$table->mediumText('content');
			$table->tinyInteger('sort')->default(0);
			$table->integer('views')->default(0);
            $table->timestamp('modified_at');
			$table->engine = 'innodb';
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
