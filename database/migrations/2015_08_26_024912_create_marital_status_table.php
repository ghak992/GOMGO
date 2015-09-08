<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMaritalStatusTable extends Migration {

	public function up()
	{
		Schema::create('marital_status', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title', 45)->unique();
		});
	}

	public function down()
	{
		Schema::drop('marital_status');
	}
}