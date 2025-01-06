<?php
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;
use Illuminate\Database\Schema\Blueprint;

class CreatePagehitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_hits', function (Blueprint $table) {
            $table->increments('id')->collation('utf8_general_ci');
            $table->unsignedInteger('fkIntAliasId')->collation('utf8_general_ci');
            $table->string('varBrowserInfo')->collation('utf8_general_ci')->nullable();
            $table->char('isWeb', 1)->default('Y')->collation('utf8_general_ci');
            $table->string('varIpAddress')->collation('utf8_general_ci')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        Schema::table('page_hits', function (Blueprint $table) 
        {
            $table->index('fkIntAliasId')->collation('utf8_general_ci');
            $table->foreign('fkIntAliasId')
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
        Schema::drop('page_hits');
    }
}
