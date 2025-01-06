<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CmsPagesTable extends Migration
{
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
				Schema::create('cms_page', function (Blueprint $table) 
				{
						$table->engine = 'InnoDB';
						$table->increments('id')->collation('utf8_general_ci');
						$table->unsignedInteger('intAliasId')->collation('utf8_general_ci');
						$table->unsignedInteger('intFKModuleCode')->collation('utf8_general_ci');
						$table->string('varTitle',255)->collation('utf8_general_ci');
						$table->text('txtDescription')->collation('utf8_general_ci')->nullable();    
						$table->text('varMetaTitle')->collation('utf8_general_ci');
						$table->text('varMetaKeyword')->collation('utf8_general_ci');
						$table->text('varMetaDescription')->collation('utf8_general_ci');
						$table->char('chrPublish')->default('Y')->collation('utf8_general_ci')->comment('Y=>Yes, N=>No');   
						$table->char('chrDelete')->default('N')->collation('utf8_general_ci')->comment('Y=>Yes, N=>No');
						$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			});
			
			Schema::table('cms_page', function(Blueprint $table) 
			{	
					$table->index('intAliasId');
					$table->index('intFKModuleCode');

					$table->foreign('intFKModuleCode')
					->references('id')
					->on('module');

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
				Schema::drop('cms_page');
		}
}
