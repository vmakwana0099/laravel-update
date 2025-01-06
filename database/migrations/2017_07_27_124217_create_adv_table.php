<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;
class CreateAdvTable extends Migration {
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up() {
		Schema::create('advertises', function (Blueprint $table) {
			$table->engine = 'InnoDB';
			$table->increments('id')->collation('utf8_general_ci');			
			$table->unsignedInteger('fkIntImgId')->collation('utf8_general_ci');
			$table->string('varTitle',255)->collation('utf8_general_ci');
			$table->datetime('dtStartDateTime')->collation('utf8_general_ci');
			$table->datetime('dtEndDateTime')->collation('utf8_general_ci')->nullable()->default(null);
			$table->text('txtLink')->collation('utf8_general_ci');
			$table->text('txtPosition')->collation('utf8_general_ci');
			$table->string('varPages',255)->collation('utf8_general_ci');
			$table->char('chrPublish')->collation('utf8_general_ci')->default('Y');
			$table->char('chrDelete')->collation('utf8_general_ci')->default('N');
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
		});

		Schema::table('advertises', function(Blueprint $table) {
				
			});
	}
	/**
  * Reverse the migrations.
	* @return void
	*/
	public function down() {
		Schema::drop('advertises');
	}
}