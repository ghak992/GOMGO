<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRequestStatusTable extends Migration {

	public function up()
	{
		Schema::create('request_status', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title', 45);
		});
	}

	public function down()
	{
		Schema::drop('request_status');
	}
}