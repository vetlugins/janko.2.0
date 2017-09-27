<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromoBannersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
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
		
		Schema::create('banner_images', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string("image_file_name")->nullable();
			$table->integer("image_file_size")->nullable();
			$table->string("image_content_type")->nullable();
			$table->timestamp("image_updated_at")->nullable();
			$table->integer('banner_id')->unsigned()->index();
			$table->smallInteger('image_num')->index();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop ( 'promo_banners' );
		Schema::drop ( 'banner_images' );
	}

}
