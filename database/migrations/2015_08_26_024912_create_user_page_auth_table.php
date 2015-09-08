<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserPageAuthTable extends Migration {

	public function up()
	{
		Schema::create('user_page_auth', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('page')->unsigned();
			$table->integer('user')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('user_page_auth');
	}
}