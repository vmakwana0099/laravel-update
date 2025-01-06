<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateEventsTable extends Migration
{
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
			Schema::create('event', function (Blueprint $table) {
						$table->engine = 'InnoDB';
						$table->increments('id')->collation('utf8_general_ci');
						$table->unsignedInteger('intAliasId')->collation('utf8_general_ci');
						$table->string('varTitle',255)->collation('utf8_general_ci');
						$table->string('fkIntImgId',400)->collation('utf8_general_ci')->nullable();
						$table->text('txtCategories')->collation('utf8_general_ci')->nullable();
						$table->unsignedInteger('fkIntVideoId')->collation('utf8_general_ci')->nullable();

						$table->string('varEventDays',255)->collation('utf8_general_ci');
						$table->string('varEventPriceType',255)->collation('utf8_general_ci')->default('Free');
						$table->float('fltAdultPrice',12,2)->collation('utf8_general_ci')->nullable();
						$table->float('fltChildPrice',12,2)->collation('utf8_general_ci')->nullable();

						$table->datetime('dtStartDateTime')->collation('utf8_general_ci');
						$table->datetime('dtEndDateTime')->collation('utf8_general_ci')->nullable()->default(NULL);
						$table->text('txtDescription')->collation('utf8_general_ci')->nullable();
						$table->string('varLatitude',255)->nullable()->collation('utf8_general_ci')->nullable();
						$table->string('varLongitude',255)->nullable()->collation('utf8_general_ci')->nullable();
						$table->text('txtAddress')->collation('utf8_general_ci')->nullable();
						$table->text('varMetaTitle')->collation('utf8_general_ci');
						$table->text('varMetaKeyword')->collation('utf8_general_ci');
						$table->text('varMetaDescription')->collation('utf8_general_ci');
						$table->unsignedInteger('intDisplayOrder')->collation('utf8_general_ci');
						$table->char('chrPublish')->collation('utf8_general_ci')->default('Y');
						$table->char('chrDelete')->collation('utf8_general_ci')->default('N');
						$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			});

			Schema::table('event', function(Blueprint $table) {
				$table->index('intAliasId');

				$table->foreign('intAliasId')
				->references('id')
				->on('alias');

			});
		}


		/**
		 * Reverse the migrations.
		 *
		 * @return void
		 */
		public function down()
		{
			Schema::drop('event');
		}
}
