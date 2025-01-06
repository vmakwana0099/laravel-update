<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;
class CreateUserSubscribersTable extends Migration {
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up() 
	{
		Schema::create('newsletter_lead', function (Blueprint $table) {
			$table->engine = 'InnoDB';
      $table->increments('id')->collation('utf8_general_ci');
			$table->string('varName',255)->collation('utf8_general_ci');			
			$table->string('varEmail',100)->collation('utf8_general_ci');			
			$table->char('chrPublish',1)->default('Y')->collation('utf8_general_ci');           
			$table->char('chrDelete',1)->default('N')->collation('utf8_general_ci');
			$table->char('chrSubscribed',1)->default('N')->collation('utf8_general_ci');
			$table->string('varIpAddress', 20)->collation('utf8_general_ci');
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
		});
	}
	
	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down() {
		Schema::drop('newsletter_lead');
	}
}
