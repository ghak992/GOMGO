<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDocumentTable extends Migration {

	public function up()
	{
		Schema::create('document', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('request')->unsigned();
			$table->string('name', 255)->unique();
			$table->string('filepath', 255);
		});
	}

	public function down()
	{
		Schema::drop('document');
	}
}