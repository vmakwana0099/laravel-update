<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;
class CreateRestaurantMenuItemsTable extends Migration{
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up(){
			Schema::create('restaurant_menu_items', function (Blueprint $table) {
				$table->engine = 'InnoDB';
				$table->increments('id')->collation('utf8_general_ci');
				$table->unsignedInteger('intAliasId')->collation('utf8_general_ci');
				$table->string('varTitle',255)->collation('utf8_general_ci');
				$table->text('fkIntImgId',400)->collation('utf8_general_ci')->nullable();
				$table->text('txtShortDescription')->collation('utf8_general_ci');
				$table->text('txtDescription')->collation('utf8_general_ci')->nullable();
				$table->text('txtCategories')->collation('utf8_general_ci')->nullable();
				$table->unsignedInteger('intPrice')->collation('utf8_general_ci');
				$table->unsignedInteger('intDisplayOrder')->collation('utf8_general_ci');				
				$table->char('chrPublish')->collation('utf8_general_ci')->default('Y');
				$table->char('chrDelete')->collation('utf8_general_ci')->default('N');				
				$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			});

			Schema::table('restaurant_menu_items', function(Blueprint $table) {				
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
				Schema::drop('restaurant_menu_items');
		}
}
