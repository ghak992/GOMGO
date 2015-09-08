<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserTable extends Migration {

	public function up()
	{
		Schema::create('user', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('first_name', 45);
			$table->string('middle_name', 45);
			$table->string('last_name', 45);
			$table->string('sair_name', 45);
			$table->string('password', 60);
			$table->string('email')->unique();
			$table->integer('role')->unsigned();
			$table->rememberToken('remember_token');
		});
	}

	public function down()
	{
		Schema::drop('user');
	}
}