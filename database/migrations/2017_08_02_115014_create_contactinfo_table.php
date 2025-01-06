<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;
class CreateContactinfoTable extends Migration {
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up() {
		Schema::create('contact_info', function (Blueprint $table) 
		{
			$table->engine = 'InnoDB';
			$table->increments('id')->collation('utf8_general_ci');
			$table->string('varTitle',255)->collation('utf8_general_ci');
			$table->text('varEmail', 100)->collation('utf8_general_ci');
			$table->text('varPhoneNo')->collation('utf8_general_ci')->nullable();
			$table->smallInteger('intDisplayOrder')->collation('utf8_general_ci');
			$table->unsignedInteger('fkIntImgId')->collation('utf8_general_ci')->nullable();
			$table->text('txtAddress')->collation('utf8_general_ci')->nullable();
			$table->string('varLatitude',255)->default('19.321187240779548')->collation('utf8_general_ci');
			$table->string('varLongitude',255)->default('-81.2274169921875')->collation('utf8_general_ci');
			$table->string('varOpeningHours', 100)->nullable()->collation('utf8_general_ci');
			$table->char('chrLatitude', 30)->collation('utf8_general_ci')->nullable();
			$table->char('chrLongitude', 30)->collation('utf8_general_ci')->nullable();
			$table->char('chrIsPrimary', 1)->default('N')->collation('utf8_general_ci');
			$table->char('chrPublish', 1)->default('Y')->collation('utf8_general_ci');
			$table->char('chrDelete', 1)->default('N')->collation('utf8_general_ci');
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));

		});

		Schema::table('contact_info', function(Blueprint $table) {
				/*$table->index('fkIntImgId');

				$table->foreign('fkIntImgId')
				->references('id')
				->on('image');*/
		});
		
	}
	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down() {
		Schema::drop('contact_info');
	}
}
