<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRequestReasoneTable extends Migration {

	public function up()
	{
		Schema::create('request_reasone', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('type', 45)->unique();
		});
	}

	public function down()
	{
		Schema::drop('request_reasone');
	}
}