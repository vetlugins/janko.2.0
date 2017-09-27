<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfolioTagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('portfolio_tags', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->string('url');
			$table->text('short_text')->nullable();
			$table->text('full_text')->nullable();
			$table->string('h1')->nullable();
			$table->string('h1_subtext')->nullable();
			$table->string('page_title')->nullable();
			$table->string('page_description')->nullable();
			$table->string('keywords')->nullable();
			$table->integer('position')->default(0)->index();
			$table->boolean('visible')->default(1)->index();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('portfolio_tags');
	}

}
