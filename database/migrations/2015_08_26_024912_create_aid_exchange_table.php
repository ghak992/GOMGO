<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAidExchangeTable extends Migration {

	public function up()
	{
		Schema::create('aid_exchange', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('financial_user')->unsigned();
			$table->float('amount');
                        $table->integer('request')->unsigned();
			$table->integer('exchange_way')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('aid_exchange');
	}
}

