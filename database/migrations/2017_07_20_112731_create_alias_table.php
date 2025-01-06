<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateAliasTable extends Migration
{
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
				Schema::create('alias', function (Blueprint $table) {
						$table->engine = 'InnoDB';
						$table->increments('id')->collation('utf8_general_ci');
						$table->unsignedInteger('intFkModuleCode')->collation('utf8_general_ci');						
						$table->string('varAlias', 255)->index()->collation('utf8_general_ci');						
						$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
						$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
				});

			Schema::table('alias', function(Blueprint $table) {
				$table->index('intFkModuleCode');
				$table->foreign('intFkModuleCode')
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
				Schema::drop('alias');
		}
}
