<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateClientTable extends Migration
{
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
				Schema::create('client', function (Blueprint $table) {
						$table->engine = 'InnoDB';
						$table->increments('id')->collation('utf8_general_ci');
						$table->unsignedInteger('intAliasId')->collation('utf8_general_ci');
						$table->string('varTitle',255)->collation('utf8_general_ci');						
						$table->unsignedInteger('fkIntImgId')->collation('utf8_general_ci')->nullable();
						$table->text('txtDescription')->collation('utf8_general_ci')->nullable();						
						$table->text('txtLink')->collation('utf8_general_ci')->nullable();
						$table->unsignedInteger('intDisplayOrder')->collation('utf8_general_ci');
						$table->char('chrDelete')->collation('utf8_general_ci')->default('N');
						$table->char('chrPublish')->collation('utf8_general_ci')->default('Y');
						$table->char('chrMenuDisplay')->collation('utf8_general_ci')->nullable();						
						$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
				});

				Schema::table('client', function(Blueprint $table) {
								                
								$table->index('intAliasId');

								$table->foreign('intAliasId')
								->references('id')
								->on('alias')
								->onDelete('cascade');

						});


		}
	/**
		 * Reverse the migrations.
		 *
		 * @return void
		 */
		public function down()
		{
				Schema::drop('client');
		}
}
