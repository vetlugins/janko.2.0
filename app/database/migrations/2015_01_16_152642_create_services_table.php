<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('services', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->string('url');
			$table->string('h1')->nullable();
			$table->string('h1_subtext')->nullable();
			$table->string('page_title')->nullable();
			$table->string('page_description')->nullable();
			$table->text('full_text')->nullable();
			$table->boolean('visible')->default(1)->index();
			$table->string('keywords')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop ('services');
	}

}
