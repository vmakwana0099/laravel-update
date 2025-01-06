<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateModulesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
		public function up()
		{
				Schema::create('module', function (Blueprint $table) 
				{
						$table->engine = 'InnoDB';
            $table->increments('id')->collation('utf8_general_ci');
            $table->string('varTitle',255)->collation('utf8_general_ci');
						$table->string('varModuleName',255)->collation('utf8_general_ci');
						$table->string('varTableName',255)->collation('utf8_general_ci');
						$table->string('varModelName',255)->collation('utf8_general_ci');
						$table->string('varModuleClass',255)->collation('utf8_general_ci');
						$table->decimal('decVersion', 3, 1)->nullable()->collation('utf8_general_ci');
						$table->integer('intDisplayOrder')->collation('utf8_general_ci');
						$table->char('chrIsFront')->collation('utf8_general_ci')->default('N');
						$table->char('chrIsPowerpanel')->collation('utf8_general_ci')->default('Y');
						$table->string('varPermissions',255)->collation('utf8_general_ci');
						$table->char('chrPublish')->collation('utf8_general_ci')->default('Y');
						$table->char('chrDelete')->collation('utf8_general_ci')->default('N');						
						$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
						$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
				});
		}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
		public function down()
		{
				Schema::drop('module');
		}
}
