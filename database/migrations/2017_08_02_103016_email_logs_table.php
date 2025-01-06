<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class EmailLogsTable extends Migration
{
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
				Schema::create('email_log', function (Blueprint $table) {
						$table->engine = 'InnoDB';
						$table->increments('id')->collation('utf8_general_ci');
						$table->unsignedInteger('intFkUserId')->collation('utf8_general_ci');
						$table->unsignedInteger('intFkEmailType')->collation('utf8_general_ci');
						$table->char('chrReceiverType')->collation('utf8_general_ci');    
						$table->unsignedInteger('intFkModuleId')->collation('utf8_general_ci');
						$table->unsignedInteger('intFkRecordId')->collation('utf8_general_ci');
						$table->string('varFrom')->collation('utf8_general_ci');
						$table->text('txtTo')->collation('utf8_general_ci');
						$table->text('txtCc')->collation('utf8_general_ci')->nullable();
						$table->text('txtBcc')->collation('utf8_general_ci')->nullable();
						$table->text('txtSubject')->collation('utf8_general_ci');
						$table->char('chrAttachment')->collation('utf8_general_ci');
						$table->char('chrIsSent')->collation('utf8_general_ci');
						$table->char('chrPublish')->collation('utf8_general_ci');
						$table->string('chrDelete')->collation('utf8_general_ci');
						$table->char('chrIpAddress')->collation('utf8_general_ci');
						$table->string('varBrowserInfo')->collation('utf8_general_ci');
						$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
				});

				Schema::table('email_log', function(Blueprint $table) {
					$table->index('intFkUserId');
					$table->index('intFkEmailType');
					$table->index('intFkModuleId');

					$table->foreign('intFkUserId')
					->references('id')
					->on('users');

					$table->foreign('intFkEmailType')
					->references('id')
					->on('email_type');

					$table->foreign('intFkModuleId')
					->references('id')
					->on('module');

				});
		}

		/**
		 * Reverse the migrations.
		 *
		 * @return void
		 */
		public function down()
		{
				Schema::drop('email_log');
		}
}
