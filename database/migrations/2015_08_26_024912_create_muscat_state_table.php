<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMuscatStateTable extends Migration {

	public function up()
	{
		Schema::create('muscat_state', function(Blueprint $table) {
			$table->increments('id');
			$table->string('state_name', 45);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('muscat_state');
	}
}