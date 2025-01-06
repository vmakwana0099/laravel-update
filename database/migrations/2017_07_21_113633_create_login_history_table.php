<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateLoginHistoryTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('login_history', function (Blueprint $table) {
			$table->increments('id')->collation('utf8_general_ci');
			$table->unsignedInteger('fkIntUserId')->collation('utf8_general_ci')->nullable();
			$table->string('varIpAddress', 20)->collation('utf8_general_ci');
			$table->char('chrDelete',1)->default('N')->collation('utf8_general_ci');
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
		});

		Schema::table('login_history', function(Blueprint $table) {	
			$table->index('fkIntUserId');			
			$table->foreign('fkIntUserId')
			->references('id')
			->on('users');
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('login_history');
	}
}
