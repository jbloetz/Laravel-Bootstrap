<?php
class Setup {

	/**
	 * Test to see if the tables are made already, this needs to be implemented, currently always says that setup hasn't run
	 * @return boolean
	 */
	public static function setup_complete(){
		return false;
	}

	/**
	 * Build all the tables that are required for the CMS framework to work
	 * @return true
	 */
	public static function setup_database(){

		// Create the users table
		Schema::table('users', function($table){
			$table->create();
			$table->increments('id');
			$table->string('username');
			$table->string('email');
			$table->string('first_name');
			$table->string('last_name');
			$table->string('password');
			$table->date('last_login');
			$table->integer('active');
			$table->integer('admin');
			$table->timestamps();
			$table->index('id');
		});

		// Create the roles table
		Schema::table('roles', function($table){
			$table->create();
			$table->increments('id');
			$table->string('slug');
			$table->string('name');
			$table->timestamps();
			$table->index('id');
		});

		// Create the users and roles pivot table
		Schema::table('role_user', function($table){
			$table->create();
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('role_id');
			$table->timestamps();
			$table->index('user_id');
			$table->index('role_id');
		});

		// Create the uploads table
		Schema::table('uploads', function($table){
			$table->create();
			$table->increments('id');
			$table->string('link_type',50);
			$table->integer('link_id');
			$table->string('filename',255);
			$table->string('small_filename',255);
			$table->string('thumb_filename',255);
			$table->string('extension',10);
			$table->integer('user_id');
			$table->integer('image');
			$table->index('link_type');
			$table->index('link_id');
			$table->index('user_id');
			$table->timestamps();
		});

		// Create the sections table
		Schema::table('sections', function($table){
			$table->create();
			$table->increments('id');
			$table->string('title',255);
			$table->text('content');
			$table->integer('order');
			$table->integer('created_by');
			$table->integer('page_id');
			$table->index('page_id');
			$table->timestamps();
		});

		// Create the pages table
		Schema::table('pages', function($table){
			$table->create();
			$table->increments('id');
			$table->string('title',255);
			$table->string('slug',255);
			$table->string('meta_title',255);
			$table->string('meta_description',255);
			$table->string('meta_keywords',255);
			$table->integer('created_by');
			$table->index('id');
			$table->timestamps();
		});

		// Create the news table
		Schema::table('news', function($table){
			$table->create();
			$table->increments('id');
			$table->string('title',255);
			$table->string('url_title',255);
			$table->text('content');
			$table->integer('created_by');
			$table->index('id');
			$table->timestamps();
		});

		// Create the gallery images table
		Schema::table('gallery_images', function($table){
			$table->create();
			$table->increments('id');
			$table->string('title',255);
			$table->integer('order');
			$table->integer('gallery_id');
			$table->integer('created_by');
			$table->index('id');
			$table->index('gallery_id');
			$table->timestamps();
		});

		// Create the gallery table
		Schema::table('gallery', function($table){
			$table->create();
			$table->increments('id');
			$table->string('title',255);
			$table->text('description');
			$table->string('default_image',255);
			$table->integer('created_by');
			$table->index('id');
			$table->timestamps();
		});
		return true;
    }
}