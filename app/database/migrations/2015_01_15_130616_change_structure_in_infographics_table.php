<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeStructureInInfographicsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('infographics', function(Blueprint $table) {			
			$table->integer ( 'position' )->default ( 0 );
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('infographics', function(Blueprint $table) {			
			$table->dropColumn('position');
		});
	}

}
