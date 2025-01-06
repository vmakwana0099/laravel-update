<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;
class CreateShowCategoryTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('show_category', function (Blueprint $table) {
          $table->engine = 'InnoDB';
          $table->increments('id')->collation('utf8_general_ci');
          $table->unsignedInteger('intAliasId')->collation('utf8_general_ci');
          $table->string('varTitle',255)->collation('utf8_general_ci');
          $table->smallInteger('intParentCategoryId')->collation('utf8_general_ci');
          $table->smallInteger('intDisplayOrder')->collation('utf8_general_ci');
          $table->text('txtShortDescription')->collation('utf8_general_ci');
          $table->text('txtDescription')->collation('utf8_general_ci')->nullable();
          $table->text('varMetaTitle')->collation('utf8_general_ci')->nullable();
          $table->text('varMetaKeyword')->collation('utf8_general_ci')->nullable();
          $table->text('varMetaDescription')->collation('utf8_general_ci')->nullable();
          $table->char('chrPublish')->collation('utf8_general_ci')->default('Y');
          $table->char('chrDelete')->collation('utf8_general_ci')->default('N');
          $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        Schema::table('show_category', function(Blueprint $table) {
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
    public function down()
    {
        Schema::drop('show_category');
    }
}