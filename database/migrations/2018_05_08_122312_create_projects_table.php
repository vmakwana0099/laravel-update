<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
          $table->engine = 'InnoDB';
          $table->increments('id')->collation('utf8_general_ci');
          $table->unsignedInteger('intAliasId')->collation('utf8_general_ci');
          $table->string('varTitle',255)->collation('utf8_general_ci');
          $table->string('fkIntImgId',400)->collation('utf8_general_ci')->nullable();
          $table->unsignedInteger('fkIntVideoId')->collation('utf8_general_ci')->nullable();
          $table->string('fkIntDocId',400)->collation('utf8_general_ci')->nullable();
          $table->unsignedInteger('fkIntTeam')->collation('utf8_general_ci')->nullable();
          $table->text('txtShortDescription')->collation('utf8_general_ci')->nullable();
          $table->text('txtDescription')->collation('utf8_general_ci')->nullable();
          $table->text('intCategory')->collation('utf8_general_ci')->nullable();
          $table->unsignedInteger('intStatus')->collation('utf8_general_ci')->nullable();
          $table->unsignedInteger('intDisplayOrder')->collation('utf8_general_ci');
          $table->char('varFeaturedProject',1)->default('N')->collation('utf8_general_ci');

          $table->float('fltRegularPrice',12,2)->collation('utf8_general_ci')->default(0);
          $table->float('fltSalePrice',12,2)->collation('utf8_general_ci')->nullable();

          $table->string('varCurrency',255)->collation('utf8_general_ci')->nullable();

          $table->string('varDiscountType',255)->collation('utf8_general_ci')->nullable();
          $table->float('fltDiscountValue',12,2)->collation('utf8_general_ci')->nullable();

          $table->unsignedInteger('intBeds')->collation('utf8_general_ci')->nullable();
          $table->float('fltBaths',12,2)->collation('utf8_general_ci')->nullable();
          $table->float('fltWidth',12,2)->collation('utf8_general_ci')->nullable();
          $table->float('fltDepth',12,2)->collation('utf8_general_ci')->nullable();
          $table->float('fltLandSize',12,2)->collation('utf8_general_ci')->nullable();
          $table->text('txtAddress')->collation('utf8_general_ci')->nullable();
          $table->string('varLatitude',255)->collation('utf8_general_ci')->nullable();
          $table->string('varLongitude',255)->collation('utf8_general_ci')->nullable();

          $table->text('varMetaTitle')->collation('utf8_general_ci');       
          $table->text('varMetaKeyword')->collation('utf8_general_ci');
          $table->text('varMetaDescription')->collation('utf8_general_ci');
          $table->char('chrPublish')->collation('utf8_general_ci')->default('Y');
          $table->char('chrDelete')->collation('utf8_general_ci')->default('N');        
          $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
          $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
          $table->unsignedInteger('flagEnqPopup')->collation('utf8_general_ci')->default(0);
            
        });

        Schema::table('projects', function(Blueprint $table) {      
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
        Schema::drop('projects');
    }
}
