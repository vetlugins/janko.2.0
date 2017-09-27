<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVisibleFieldInPortfolioSlidersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('portfolio_sliders', function(Blueprint $table)
		{
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
		Schema::table('portfolio_sliders', function(Blueprint $table)
		{
			$table->dropColumn('visible');
		});
	}

}
