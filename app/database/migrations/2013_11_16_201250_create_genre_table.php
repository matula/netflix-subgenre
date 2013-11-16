<?php

use Illuminate\Database\Migrations\Migration;

class CreateGenreTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Creates the users table
		Schema::create('genres', function($table)
		{
		    $table->increments('id');
		    $table->string('code')->unique();
		    $table->string('genre');
		    $table->string('movies');
		    $table->timestamps();
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
		Schema::drop('genres');
	}

}