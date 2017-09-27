<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewsitemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('views_items', function(Blueprint $table) {			
			$table->increments('id');
			$table->string('title');
			$table->text('text')->nullable();
			$table->boolean ( 'visible' )->default ( 1 );
			$table->integer ( 'position' )->default ( 0 );
			$table->smallInteger ( 'num' );
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
		Schema::drop ( 'views_items' );
	}

}
