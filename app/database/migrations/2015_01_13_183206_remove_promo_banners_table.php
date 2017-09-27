<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemovePromoBannersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::drop('promo_banners');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::create('promo_banners', function(Blueprint $table) {			
			$table->increments('id');
			$table->string('title');
			$table->string('object_type');
			$table->string('object_result');
			$table->text('text')->nullable();
			$table->string('button_text')->default ( '' );
			$table->boolean ( 'visible' )->default ( 1 );
			$table->timestamps ();
			$table->softDeletes();
		});
	}

}
