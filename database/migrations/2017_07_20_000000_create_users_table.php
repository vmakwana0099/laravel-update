<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;
class CreateUsersTable extends Migration {
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up() {
    Schema::create('users', function (Blueprint $table) {
      $table->engine = 'InnoDB';
      $table->increments('id')->collation('utf8_general_ci');
      $table->string('name',255)->collation('utf8_general_ci');
      $table->string('email')->collation('utf8_general_ci')->unique();
      $table->string('personalId')->collation('utf8_general_ci')->nullable();
      $table->unsignedInteger('fkIntImgId')->collation('utf8_general_ci')->nullable();
      $table->string('password')->collation('utf8_general_ci');
      $table->char('chrDelete',1)->default('N')->collation('utf8_general_ci');
      $table->char('chrPublish',1)->default('Y')->collation('utf8_general_ci');
      $table->rememberToken()->collation('utf8_general_ci');
      $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
      $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
    });
      
    // Schema::table('users', function(Blueprint $table) 
    // {
    //   $table->index('fkIntImgId');          
    //   $table->foreign('fkIntImgId')
    //     ->references('id')
    //     ->on('image');
    // });
    
  }
  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down() {
    Schema::drop('users');
  }
}