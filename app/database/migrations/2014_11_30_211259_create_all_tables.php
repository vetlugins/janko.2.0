<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('email')->unique();
			$table->string('name')->nullable();
			$table->string('remember_token', 100)->nullable()->index();
			$table->string('password')->nullable();
			$table->timestamps();
		});
		
		Schema::create('password_reminders', function(Blueprint $table)
		{
			$table->string('email')->index();
			$table->string('token')->index();
			$table->timestamp('created_at');
		});
		
		Schema::create('activities', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index();
			$table->integer('observable_id')->unsigned()->index();
			$table->string('observable_type');
			$table->string('observable_name');
			$table->string('user_name');
			$table->string('type');
			$table->timestamps();
		});
		
		Schema::create('pages', function($table) {
			$table->increments('id');
			$table->string('title');
			$table->string('url');
			$table->text('short_text')->nullable();
			$table->text('full_text')->nullable();
			$table->string('h1')->nullable();
			$table->string('h1_subtext')->nullable();
			$table->string('page_title')->nullable();
			$table->string('page_description')->nullable();
			$table->string('keywords')->nullable();
			$table->string('self_url');
			$table->integer('parent_id')->default(0);
			$table->integer('children')->default(0);
			$table->integer('position')->default(0)->index();
			$table->boolean('redirect')->default(0);
			$table->boolean('visible')->default(1)->index();
			$table->string('lang',2)->default('ru');
			$table->softDeletes();
			$table->timestamps();			
		});
		
		Schema::create('news', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->text('preview')->nullable();
			$table->longtext('text')->nullable();
			$table->timestamp('date')->nullable()->index();
			$table->string('url');
			$table->string('page_title')->nullable();
			$table->string('page_description')->nullable();
			$table->string('keywords')->nullable();
			$table->boolean('visible')->default(1)->index();
			$table->softDeletes();
			$table->string('lang',2)->default('ru');
			$table->timestamps();
		});
		
		Schema::create('covers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string("image_file_name")->nullable();
			$table->integer("image_file_size")->nullable();
			$table->string("image_content_type")->nullable();
			$table->timestamp("image_updated_at")->nullable();
			$table->integer('coverable_id')->unsigned()->index()->nullable();
			$table->string('coverable_type')->index()->nullable();
			$table->timestamps();
		});
		
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
		
		Schema::create('menus', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');			
			$table->string('type',6);
			$table->smallInteger('max_items')->unsigned()->default(0);			
		});
		
		Schema::create('menu_page', function(Blueprint $table)
		{
			$table->integer('menu_id')->index();
			$table->integer('page_id')->index();
		});
		
		Schema::create('objects', function(Blueprint $table)
		{			
			$table->increments('id');
			$table->string('title');
			$table->string('sub_title')->nullable();			
			$table->text('short_text')->nullable();
			$table->text('text')->nullable();		
			$table->string('h1')->nullable();			
			$table->string('page_title')->default('');
			$table->string('page_description')->default('');
			$table->string('keywords')->default('');			
			$table->string('url');			
			$table->boolean('visible')->default(1)->index();
			$table->boolean('rotation')->default(0)->index();
			$table->boolean('bestseller')->default(0)->index();
			$table->string('cost')->nullable()->index();
			$table->smallInteger('discount')->nullable();
			$table->integer('available')->nullable();
			$table->integer('brand_id')->default(0)->index();
			$table->integer('catrubric_id')->index();
			$table->string('lang',2)->default('ru');
			$table->softDeletes();
			$table->timestamps();
		});
		
		Schema::create('cat_rubrics', function(Blueprint $table)
		{			
			$table->increments('id');
			$table->string('title');
			$table->text('text')->nullable();
			$table->string('url');
			$table->string('self_url');
			$table->string('h1')->nullable();
			$table->string('page_title')->nullable();
			$table->string('page_description')->nullable();
			$table->string('keywords')->nullable();
			$table->boolean('visible')->default(1)->index();			
			$table->integer('parent_id')->unsigned()->default(0)->index();
			$table->integer('position')->default(0)->index();
			$table->boolean('children')->default(0);			
			$table->softDeletes();
			$table->timestamps();
		});
		
		Schema::create('albums', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->string('url');			
			$table->text('text')->nullable();
			$table->string('page_title')->nullable();
			$table->string('page_description')->nullable();
			$table->string('keywords')->nullable();
			$table->string('h1')->nullable();
			$table->boolean('visible')->default(0)->index();
			$table->integer('position')->default(0)->index();
			$table->integer('parent_id')->default(0)->index();
			$table->integer('children')->default(0);
			$table->timestamps();
			$table->softDeletes();
		});
		
		Schema::create('photos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->boolean('visible')->default(0)->index();
			$table->integer('position')->default(0)->index();
			$table->boolean('rotation')->default(1)->index();
			$table->integer('object_id')->default(0)->index();
			$table->string('object_type',60)->default('');
			$table->string ( 'image_file_name' )->nullable();
			$table->integer ( 'image_file_size' )->nullable();
			$table->string ( 'image_content_type' )->nullable();
			$table->timestamp ( 'image_updated_at' )->nullable();
		});
		
		Schema::create('site_params', function(Blueprint $table) {			
			$table->string('id',30)->unique('id');
			$table->string('name');
			$table->string('value');
		});
		
		Schema::create('orders', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('person_name');
			$table->string('person_phone');
			$table->string('person_email');
			$table->string('person_address');
			$table->string('comment');
			$table->integer('total_cost');
			$table->integer('discount');
			$table->timestamp('date')->index();
			$table->smallInteger('status')->nullable();		
		});
		
		Schema::create('order_objects', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('order_id');
			$table->integer('objects_id');			
		});
		
		Schema::create('roles', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->index();
		});
		
		Schema::create('role_user', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('role_id')->unsigned()->index();
			$table->integer('user_id')->unsigned()->index();			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop ( 'pages' );
		Schema::drop ( 'users' );
		Schema::drop ( 'password_reminders' );
		Schema::drop ( 'activities' );
		Schema::drop ( 'news' );
		Schema::drop ( 'covers' );
		Schema::drop ( 'photos' );
		Schema::drop ( 'banners_places' );
		Schema::drop ( 'menus' );
		Schema::drop ( 'banners' );
		Schema::drop ( 'menu_page' );
		Schema::drop ( 'objects' );
		Schema::drop ( 'cat_rubrics' );
		Schema::drop ( 'albums' );
		Schema::drop ( 'site_params' );
		Schema::drop ( 'order_objects' );
		Schema::drop ( 'orders' );
		Schema::drop( 'roles' );
		Schema::drop( 'role_user' );
	}
	
	

}
