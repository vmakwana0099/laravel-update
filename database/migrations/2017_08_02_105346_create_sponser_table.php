<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;
class CreateSponserTable extends Migration {
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up(){
			Schema::create('sponsor', function (Blueprint $table) {
				$table->increments('id')->collation('utf8_general_ci');				
				$table->unsignedInteger('fkIntImgId')->collation('utf8_general_ci')->nullable();
				$table->string('varTitle',255)->collation('utf8_general_ci');
				$table->string('varExternalLink',255)->collation('utf8_general_ci')->nullable();		
				$table->text('txtCategories')->collation('utf8_general_ci')->nullable();		
				$table->unsignedInteger('intDisplayOrder')->collation('utf8_general_ci');
				$table->char('chrPublish')->collation('utf8_general_ci')->default('Y');
				$table->char('chrDelete')->collation('utf8_general_ci')->default('N');
				$table->text('varMetaTitle')->collation('utf8_general_ci')->nullable();
				$table->text('varMetaKeyword')->collation('utf8_general_ci')->nullable();
				$table->text('varMetaDescription')->collation('utf8_general_ci')->nullable();
				$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
				$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			});
			Schema::table('sponsor', function(Blueprint $table) {
				
			});			
		}
		/**
		 * Reverse the migrations.
		 *
		 * @return void
		 */
		public function down(){
			Schema::drop('sponsor');
		}
}