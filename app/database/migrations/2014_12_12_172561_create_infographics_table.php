<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfographicsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('infographics', function(Blueprint $table) {			
			$table->increments('id');
			$table->string('title')->default('');
			$table->string('count')->default('');
			$table->boolean ( 'visible' )->default ( 0 );
			$table->timestamps ();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop ( 'infographics' );
	}

}
