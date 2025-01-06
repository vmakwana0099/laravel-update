<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateBannersTable extends Migration{
		 public function up(){
				Schema::create('banner', function (Blueprint $table) {
						
						$table->engine = 'InnoDB';
						$table->increments('id')->collation('utf8_general_ci');
						$table->unsignedInteger('fkIntImgId')->collation('utf8_general_ci')->nullable();
						$table->unsignedInteger('fkIntVideoId')->collation('utf8_general_ci')->nullable();
						$table->unsignedInteger('fkIntPageId')->collation('utf8_general_ci')->nullable();
						$table->unsignedInteger('fkModuleId')->collation('utf8_general_ci')->nullable();
						$table->string('varTitle')->collation('utf8_general_ci')->nullable();
						$table->string('varBannerType')->collation('utf8_general_ci')->nullable();
						$table->string('varBannerVersion')->collation('utf8_general_ci')->default('img_banner');
						$table->integer('intDisplayOrder')->collation('utf8_general_ci')->default(0); 
						$table->text('txtDescription')->collation('utf8_general_ci')->nullable();
						$table->char('chrPublish',1)->default('Y')->collation('utf8_general_ci');
						$table->char('chrDelete',1)->default('N')->collation('utf8_general_ci');
						$table->char('chrDefaultBanner',1)->default('N')->collation('utf8_general_ci');
						$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
				});

				Schema::table('banner', function(Blueprint $table) 
				{        
						$table->index('fkModuleId'); 
						$table->foreign('fkModuleId')
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
				Schema::drop('banner');
		}
}
