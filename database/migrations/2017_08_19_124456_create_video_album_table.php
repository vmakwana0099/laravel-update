<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateVideoAlbumTable extends Migration
{
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
				Schema::create('video_album', function (Blueprint $table) {
						
								$table->increments('id')->collation('utf8_general_ci');
								$table->string('varTitle',255)->collation('utf8_general_ci');
								$table->unsignedInteger('intAliasId')->collation('utf8_general_ci');
								$table->unsignedInteger('fkIntVideoId')->collation('utf8_general_ci');
								$table->unsignedInteger('intDisplayOrder')->collation('utf8_general_ci');
								$table->text('txtDescription')->collation('utf8_general_ci')->nullable();
								$table->char('chrDisplay',1)->default('Y')->collation('utf8_general_ci');
								$table->char('chrPublish',1)->default('Y')->collation('utf8_general_ci');
								$table->char('chrDelete',1)->default('N')->collation('utf8_general_ci');
								$table->text('varMetaTitle',160)->collation('utf8_general_ci');
								$table->text('varMetaKeyword',160)->collation('utf8_general_ci');
								$table->text('varMetaDescription',160)->collation('utf8_general_ci');
								$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
												
				});

				Schema::table('video_album', function(Blueprint $table) {
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
				Schema::drop('video_album');
		}
}
