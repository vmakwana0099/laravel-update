<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateImageTable extends Migration
{
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
				Schema::create('image', function (Blueprint $table) 
				{
						$table->engine = 'InnoDB';
						$table->increments('id')->collation('utf8_general_ci');
						$table->unsignedInteger('fkIntUserId')->collation('utf8_general_ci');
						$table->text('txtImageName')->collation('utf8_general_ci');
						$table->text('txtImgOriginalName')->collation('utf8_general_ci');
						$table->string('varImageExtension',10)->collation('utf8_general_ci');
						$table->char('chrIsUserUploaded',1)->default('N')->collation('utf8_general_ci');
						$table->char('chrPublish',1)->default('Y')->collation('utf8_general_ci');
						$table->char('chrDelete',1)->default('N')->collation('utf8_general_ci');
						$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
						$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
				});

				Schema::table('image', function(Blueprint $table) {
					$table->index('fkIntUserId');
					$table->foreign('fkIntUserId')
					->references('id')
					->on('users');
				});	
		}

		/**
		 * Reverse the migrations.
		 *
		 * @return void
		 */
		public function down()
		{
				Schema::drop('image');
		}
}
