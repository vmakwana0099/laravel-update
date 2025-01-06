<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateAppointmentLeadTable extends Migration
{
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
				Schema::create('appointment_lead', function (Blueprint $table) {
						$table->engine = 'InnoDB';
						$table->increments('id')->collation('utf8_general_ci');
						$table->unsignedInteger('fkIntServiceId')->collation('utf8_general_ci')->nullable();
						$table->string('varName', 255)->collation('utf8_general_ci');
						$table->string('varEmail', 100)->collation('utf8_general_ci');
						$table->string('varPhoneNo')->collation('utf8_general_ci')->nullable();
						$table->text('txtUserMessage')->collation('utf8_general_ci')->nullable();
						$table->text('txtComments')->collation('utf8_general_ci')->nullable();
						$table->dateTime('appointmentDate')->collation('utf8_general_ci')->default(Carbon::now());
						$table->char('chrPublish', 1)->default('Y')->collation('utf8_general_ci');
						$table->char('chrDelete', 1)->default('N')->collation('utf8_general_ci');
						$table->string('varIpAddress', 20)->collation('utf8_general_ci');
						$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
				});
		

		Schema::table('appointment_lead', function(Blueprint $table){	
					$table->index('fkIntServiceId');
					$table->foreign('fkIntServiceId')
					->references('id')
					->on('services');
					
				});
		}
		/**
		 * Reverse the migrations.
		 *
		 * @return void
		 */
		public function down()
		{
			 Schema::drop('appointment_lead');
		}
}
