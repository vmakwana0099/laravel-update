<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;
class CreateCareersTable extends Migration {
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up() {

		Schema::create('careers', function (Blueprint $table) 
		{

			$table->engine = 'InnoDB';
			$table->increments('id')->collation('utf8_general_ci');
			$table->unsignedInteger('intAliasId')->collation('utf8_general_ci');
			$table->string('fkIntImgId',255)->collation('utf8_general_ci')->nullable();
			$table->string('varTitle',255)->collation('utf8_general_ci');
			$table->datetime('dtDateTime')->collation('utf8_general_ci');
			$table->string('varExternalLink',255)->collation('utf8_general_ci')->nullable();
			$table->text('txtShortDescription')->collation('utf8_general_ci');
			$table->text('txtDescription')->collation('utf8_general_ci')->nullable();
			$table->text('txtCategories')->collation('utf8_general_ci')->nullable();
			$table->unsignedInteger('intDisplayOrder')->collation('utf8_general_ci');
			$table->char('chrPublish')->collation('utf8_general_ci')->default('Y');
			$table->char('chrDelete')->collation('utf8_general_ci')->default('N');
			$table->text('varMetaTitle')->collation('utf8_general_ci');
			$table->text('varMetaKeyword')->collation('utf8_general_ci');
			$table->text('varMetaDescription')->collation('utf8_general_ci');
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));

		});

		Schema::table('careers', function(Blueprint $table) {
							
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
	public function down() {
		Schema::drop('careers');
	}
}