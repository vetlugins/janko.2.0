<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveAffiliatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::drop ( 'affiliates' );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::create('affiliates', function(Blueprint $table) {			
			$table->increments('id');
			$table->string('title')->default('');
			$table->string('address')->default('');
			$table->string('latitude')->default('');
			$table->string('longitude')->default('');
			$table->string('phone')->default('');
			$table->string('email')->default('');
			$table->boolean ( 'visible' )->default ( 0 );
			$table->timestamps ();
			$table->softDeletes();
		});
	}

}
