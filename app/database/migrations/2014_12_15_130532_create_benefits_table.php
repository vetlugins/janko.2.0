<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBenefitsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('benefits', function(Blueprint $table) {			
			$table->increments('id');
			$table->string('title');
			$table->text('preview')->nullable();
			$table->text('text')->nullable();
			$table->boolean ( 'visible' )->default ( 1 );
			$table->integer ( 'position' )->default ( 0 );
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
		Schema::drop ( 'benefits' );
	}

}
