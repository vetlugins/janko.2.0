<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOtzyvyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reviews', function(Blueprint $table) {			
			$table->increments('id');
			$table->string('title');
			$table->string('text');
			$table->string('person_name')->default('');
			$table->date('date');
			$table->string('contract')->default('');
			$table->boolean ( 'visible' )->default ( 0 );
			$table->string('url');
			$table->string('page_title')->default('');
			$table->string('page_description')->default('');
			$table->string('keywords')->default('');
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
		Schema::drop ( 'reviews' );
	}

}
