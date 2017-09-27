<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfolioBannersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('portfolio_sliders', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string("image_file_name")->nullable();
			$table->integer("image_file_size")->nullable();
			$table->string("image_content_type")->nullable();
			$table->timestamp("image_updated_at")->nullable();
			$table->integer('portfolio_id')->unsigned()->index();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop ( 'portfolio_sliders' );
	}

}
