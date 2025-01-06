<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;
class CreateRestaurantReservationsLeadTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
			Schema::create('restaurant_reservations_lead', function (Blueprint $table) {
					$table->engine = 'InnoDB';
					$table->increments('id')->collation('utf8_general_ci');						
					$table->string('varName', 255)->collation('utf8_general_ci');
					$table->string('varEmail', 100)->collation('utf8_general_ci');
					$table->string('varPhoneNo')->collation('utf8_general_ci')->nullable();
					$table->datetime('dtDateTime')->collation('utf8_general_ci')->default(Carbon::now());
					$table->string('varOccasions', 255)->collation('utf8_general_ci')->nullable();
					$table->text('txtSplRequests')->collation('utf8_general_ci')->nullable();
					$table->integer('intPeople')->collation('utf8_general_ci')->nullable();
					$table->char('chrPublish', 1)->default('Y')->collation('utf8_general_ci');
					$table->char('chrDelete', 1)->default('N')->collation('utf8_general_ci');
					$table->string('varIpAddress', 20)->collation('utf8_general_ci')->nullable();
					$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
			Schema::drop('restaurant_reservations_lead');
	}
}
