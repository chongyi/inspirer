<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('navs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->string('link');
			$table->integer('parent_id')->default(0);
			$table->tinyInteger('sort')->default(0);
			$table->timestamps();
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
		Schema::drop('navs');
	}

}
