<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfographicsTabledd extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('infographics', function(Blueprint $table) {			
			$table->increments('id');
			$table->string('title');
			$table->boolean ( 'visible' )->default ( 1 );
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
		Schema::drop('infographics');
	}

}
