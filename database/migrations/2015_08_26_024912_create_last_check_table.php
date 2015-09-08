<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLastCheckTable extends Migration {

	public function up()
	{
		Schema::create('last_check', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('request')->unsigned();
			$table->integer('checker')->unsigned();
			$table->text('not')->nullable();
			$table->float('aide_amount');
		});
	}

	public function down()
	{
		Schema::drop('last_check');
	}
}