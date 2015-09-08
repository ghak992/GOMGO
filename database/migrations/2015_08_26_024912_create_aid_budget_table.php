<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAidBudgetTable extends Migration {

	public function up()
	{
		Schema::create('aid_budget', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->date('year');
			$table->integer('creator')->unsigned();
			$table->float('amount')->default('0.0');
		});
	}

	public function down()
	{
		Schema::drop('aid_budget');
	}
}