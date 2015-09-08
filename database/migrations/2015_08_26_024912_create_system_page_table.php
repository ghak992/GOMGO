<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSystemPageTable extends Migration {

	public function up()
	{
		Schema::create('system_page', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
                        $table->text('note')->nullable();
			$table->string('title', 500);
			$table->string('path', 500);
		});
	}

	public function down()
	{
		Schema::drop('system_page');
	}
}