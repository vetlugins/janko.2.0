<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveBannersTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::drop('banners');
		Schema::drop('banner_images');
		Schema::drop('banners_places');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::create('banners', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->string('link')->nullable();
			$table->smallInteger('place_id')->unsigned()->index();
			$table->integer('date_start')->unsigned();
			$table->integer('date_end')->unsigned();	
			$table->boolean('visible')->default(1)->index();
			$table->string('lang',2)->default('ru');
			$table->softDeletes();
			$table->timestamps();			
		});
		
		Schema::create('banners_places', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->integer('width')->unsigned();
			$table->integer('height')->unsigned();
			$table->string('type', 60);
			$table->string('text')->nullable();
		});

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
