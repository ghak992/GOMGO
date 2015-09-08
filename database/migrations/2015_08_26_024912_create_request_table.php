<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRequestTable extends Migration {

	public function up()
	{
		Schema::create('request', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('status')->unsigned();
			$table->string('requester_first_name', 45);
			$table->string('requester_middle_name', 45);
			$table->string('requester_last_name');
			$table->string('requester_sair_name');
			$table->date('requester_bod');
			$table->integer('requester_civil_id');
			$table->string('requester_bank_acount_id');
			$table->string('requester_gender', 5)->default('M');
			$table->integer('requester_marital_status')->unsigned();
			$table->integer('address_state')->unsigned();
			$table->string('requester_address_district', 85);
			$table->string('requester_phone', 12);
			$table->integer('reasone')->unsigned();
			$table->text('note');
			$table->integer('creator')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('request');
	}
}