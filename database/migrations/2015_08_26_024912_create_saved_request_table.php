<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSavedRequestTable extends Migration {

	public function up()
	{
		Schema::create('saved_request', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('request')->unsigned();
			$table->integer('saved_by')->unsigned();
			$table->integer('last_status');
			$table->text('not')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('saved_request');
	}
}