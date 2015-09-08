<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('user', function(Blueprint $table) {
			$table->foreign('role')->references('id')->on('role')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('aid_budget', function(Blueprint $table) {
			$table->foreign('creator')->references('id')->on('user')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('request', function(Blueprint $table) {
			$table->foreign('status')->references('id')->on('request_status')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('request', function(Blueprint $table) {
			$table->foreign('requester_marital_status')->references('id')->on('marital_status')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('request', function(Blueprint $table) {
			$table->foreign('address_state')->references('id')->on('muscat_state')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('request', function(Blueprint $table) {
			$table->foreign('reasone')->references('id')->on('request_reasone')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('request', function(Blueprint $table) {
			$table->foreign('creator')->references('id')->on('user')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('first_check', function(Blueprint $table) {
			$table->foreign('request')->references('id')->on('request')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('first_check', function(Blueprint $table) {
			$table->foreign('checker')->references('id')->on('user')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('document', function(Blueprint $table) {
			$table->foreign('request')->references('id')->on('request')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('last_check', function(Blueprint $table) {
			$table->foreign('request')->references('id')->on('request')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('last_check', function(Blueprint $table) {
			$table->foreign('checker')->references('id')->on('user')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('saved_request', function(Blueprint $table) {
			$table->foreign('request')->references('id')->on('request')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('saved_request', function(Blueprint $table) {
			$table->foreign('saved_by')->references('id')->on('user')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('saved_request', function(Blueprint $table) {
			$table->foreign('last_status')->references('id')->on('request_status')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('aid_exchange', function(Blueprint $table) {
			$table->foreign('financial_user')->references('id')->on('user')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('aid_exchange', function(Blueprint $table) {
			$table->foreign('exchange_way')->references('id')->on('exchange_way')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('aid_exchange', function(Blueprint $table) {
			$table->foreign('request')->references('id')->on('request')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('user_page_auth', function(Blueprint $table) {
			$table->foreign('page')->references('id')->on('system_page')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('user_page_auth', function(Blueprint $table) {
			$table->foreign('user')->references('id')->on('user')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('user', function(Blueprint $table) {
			$table->dropForeign('user_role_foreign');
		});
		Schema::table('aid_budget', function(Blueprint $table) {
			$table->dropForeign('aid_budget_creator_foreign');
		});
		Schema::table('request', function(Blueprint $table) {
			$table->dropForeign('request_status_foreign');
		});
		Schema::table('request', function(Blueprint $table) {
			$table->dropForeign('request_requester_marital_status_foreign');
		});
		Schema::table('request', function(Blueprint $table) {
			$table->dropForeign('request_address_state_foreign');
		});
		Schema::table('request', function(Blueprint $table) {
			$table->dropForeign('request_reasone_foreign');
		});
		Schema::table('request', function(Blueprint $table) {
			$table->dropForeign('request_creator_foreign');
		});
		Schema::table('first_check', function(Blueprint $table) {
			$table->dropForeign('first_check_request_foreign');
		});
		Schema::table('first_check', function(Blueprint $table) {
			$table->dropForeign('first_check_checker_foreign');
		});
		Schema::table('document', function(Blueprint $table) {
			$table->dropForeign('document_request_foreign');
		});
		Schema::table('last_check', function(Blueprint $table) {
			$table->dropForeign('last_check_request_foreign');
		});
		Schema::table('last_check', function(Blueprint $table) {
			$table->dropForeign('last_check_checker_foreign');
		});
		Schema::table('saved_request', function(Blueprint $table) {
			$table->dropForeign('saved_request_request_foreign');
		});
		Schema::table('saved_request', function(Blueprint $table) {
			$table->dropForeign('saved_request_saved_by_foreign');
		});
		Schema::table('saved_request', function(Blueprint $table) {
			$table->dropForeign('saved_request_last_status_foreign');
		});
		Schema::table('aid_exchange', function(Blueprint $table) {
			$table->dropForeign('aid_exchange_financial_user_foreign');
		});
		Schema::table('aid_exchange', function(Blueprint $table) {
			$table->dropForeign('aid_exchange_exchange_way_foreign');
		});
		Schema::table('aid_exchange', function(Blueprint $table) {
			$table->dropForeign('aid_exchange_request_foreign');
		});
		Schema::table('user_page_auth', function(Blueprint $table) {
			$table->dropForeign('user_page_auth_page_foreign');
		});
		Schema::table('user_page_auth', function(Blueprint $table) {
			$table->dropForeign('user_page_auth_user_foreign');
		});
	}
}