<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConversionFieldsInPortfolioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('portfolio', function(Blueprint $table)
		{
			$table->integer("cv1")->nullable();
			$table->integer("cv2")->nullable();
			$table->integer("cv3")->nullable();

			$table->string("cr1")->nullable();
			$table->string("cr2")->nullable();
			$table->string("cr3")->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('portfolio', function(Blueprint $table)
		{
			$table->dropColumn('cv1');
			$table->dropColumn('cv2');
			$table->dropColumn('cv3');
			$table->dropColumn('cr1');
			$table->dropColumn('cr2');
			$table->dropColumn('cr3');
		});
	}

}
