<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateEventsLeadsTable extends Migration
{
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
			Schema::create('event_lead', function (Blueprint $table) {
						$table->engine = 'InnoDB';
						$table->increments('id')->collation('utf8_general_ci');
						$table->string('varTitle',255)->collation('utf8_general_ci');
						$table->unsignedInteger('fkIntEventId')->collation('utf8_general_ci');
						$table->datetime('dtCommingDateTime')->collation('utf8_general_ci')->nullable();
						$table->text('txtComments')->collation('utf8_general_ci')->nullable();
						$table->string('varEmail', 100)->collation('utf8_general_ci');
						$table->string('varPhoneNo')->collation('utf8_general_ci')->nullable();
						$table->char('chrInterest')->collation('utf8_general_ci')->default('N');
						$table->Integer('intNoOfPeople')->collation('utf8_general_ci')->default(0);
						$table->char('chrPublish')->collation('utf8_general_ci')->default('Y');
						$table->char('chrDelete')->collation('utf8_general_ci')->default('N');
						$table->string('varIpAddress', 20)->collation('utf8_general_ci');
						$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			});

			Schema::table('event_lead', function(Blueprint $table) {

			});
		}


		/**
		 * Reverse the migrations.
		 *
		 * @return void
		 */
		public function down()
		{
			Schema::drop('event_lead');
		}
}
