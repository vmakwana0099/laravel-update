<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateMenuTable extends Migration
{
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
				Schema::create('menu', function (Blueprint $table) {
						$table->engine = 'InnoDB';
						$table->increments('id')->collation('utf8_general_ci');
						$table->unsignedInteger('intParentMenuId')->collation('utf8_general_ci');
						$table->unsignedInteger('intItemOrder')->collation('utf8_general_ci')->default('1');
						$table->unsignedInteger('intParentItemOrder')->collation('utf8_general_ci')->default('1');
						$table->unsignedInteger('intPosition')->collation('utf8_general_ci')->default('1');
						$table->unsignedInteger('intAliasId')->collation('utf8_general_ci')->nullable();
						$table->unsignedInteger('intPageId')->collation('utf8_general_ci')->nullable();
						$table->string('varTitle', 255)->collation('utf8_general_ci');
						$table->text('txtPageUrl')->collation('utf8_general_ci');						
						$table->char('chrActive',1)->default('Y')->collation('utf8_general_ci');
						$table->char('chrInMobile',1)->default('Y')->collation('utf8_general_ci');
						$table->char('chrInWeb',1)->default('Y')->collation('utf8_general_ci');
						$table->char('chrMegaMenu',1)->default('N')->collation('utf8_general_ci');
						$table->char('chrDelete',1)->default('N')->collation('utf8_general_ci');
						$table->char('chrPublish',1)->default('Y')->collation('utf8_general_ci');
						$table->timestamp('created_at')->collation('utf8_general_ci')->default(Carbon::now());  
						$table->timestamp('updated_at')->collation('utf8_general_ci')->default(Carbon::now());
				});

				Schema::table('menu', function(Blueprint $table){	
					$table->index('intPageId');
					$table->index('intAliasId');
					$table->index('intPosition');

					$table->foreign('intAliasId')
					->references('id')
					->on('alias')
					->onDelete('cascade');
					
					$table->foreign('intPageId')
					->references('id')
					->on('cms_page')
					->onDelete('cascade');

					$table->foreign('intPosition')
					->references('id')
					->on('menu_type')
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
				Schema::drop('menu');
		}
}
