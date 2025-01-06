<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateImageModuleRelTable extends Migration
{
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
				Schema::create('image_module_rel', function (Blueprint $table) {
						$table->engine = 'InnoDB';
						$table->increments('id')->collation('utf8_general_ci');						
						$table->unsignedInteger('intFkImgId')->collation('utf8_general_ci')->nullable();
						$table->unsignedInteger('intFkModuleCode')->nullable()->collation('utf8_general_ci');
						$table->unsignedInteger('intRecordId')->nullable()->collation('utf8_general_ci');
						$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
				});		

				Schema::table('image_module_rel', function(Blueprint $table){	
					$table->index('intRecordId');
					$table->index('intFkImgId');
					$table->foreign('intFkImgId')
					->references('id')
					->on('image');

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
			 Schema::drop('image_module_rel');
		}
}
