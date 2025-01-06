<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;
class CreateShowsTable extends Migration {  
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('show', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->collation('utf8_general_ci');
            $table->unsignedInteger('intAliasId')->collation('utf8_general_ci');
            $table->string('fkIntImgId',400)->collation('utf8_general_ci')->nullable();
            $table->unsignedInteger('fkIntVideoId')->collation('utf8_general_ci');
            $table->text('txtCategories')->collation('utf8_general_ci')->nullable();
            $table->string('varTitle',255)->collation('utf8_general_ci');
            $table->string('varShowDays',255)->collation('utf8_general_ci');
            $table->string('varAuthor',255)->collation('utf8_general_ci')->nullable();
            $table->datetime('dtStartDateTime')->collation('utf8_general_ci');
            $table->datetime('dtEndDateTime')->collation('utf8_general_ci')->nullable()->default(NULL);
            $table->text('txtShortDescription')->collation('utf8_general_ci')->nullable();
            $table->text('txtDescription')->collation('utf8_general_ci')->nullable();
            $table->char('varFeaturedShow',1)->default('N')->collation('utf8_general_ci');
            $table->text('varMetaTitle')->collation('utf8_general_ci');
            $table->text('varMetaKeyword')->collation('utf8_general_ci');
            $table->text('varMetaDescription')->collation('utf8_general_ci');
            $table->unsignedInteger('intDisplayOrder')->collation('utf8_general_ci');
            $table->char('chrPublish')->collation('utf8_general_ci')->default('Y');
            $table->char('chrDelete')->collation('utf8_general_ci')->default('N');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
      });

      Schema::table('show', function(Blueprint $table) {        
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
      Schema::drop('show');
    }
}