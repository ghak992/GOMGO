<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExchangeWayTable extends Migration {

	public function up()
	{
		Schema::create('exchange_way', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 100)->unique();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('exchange_way');
	}
}