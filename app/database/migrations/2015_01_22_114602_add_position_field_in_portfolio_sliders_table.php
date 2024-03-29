<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPositionFieldInPortfolioSlidersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('portfolio_sliders', function(Blueprint $table)
		{
			$table->integer('position')->default(0)->index();
			$table->boolean('rotation')->default(0)->index();
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
			$table->dropColumn('position');
			$table->dropColumn('rotation');
		});
	}

}
