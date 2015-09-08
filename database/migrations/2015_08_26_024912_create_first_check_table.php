<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFirstCheckTable extends Migration {

	public function up()
	{
		Schema::create('first_check', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('request')->unsigned();
			$table->integer('checker')->unsigned();
			$table->text('not')->nullable();
			$table->float('aid_amount');
		});
	}

	public function down()
	{
		Schema::drop('first_check');
	}
}