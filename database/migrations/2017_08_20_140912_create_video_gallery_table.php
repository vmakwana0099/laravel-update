<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateVideoGalleryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_gallery', function (Blueprint $table) {
                $table->increments('id')->collation('utf8_general_ci');
                $table->unsignedInteger('fkIntAlbumId')->collation('utf8_general_ci')->nullable();
                $table->unsignedInteger('fkIntVideoId')->collation('utf8_general_ci');
                $table->string('varTitle',255)->collation('utf8_general_ci');
                $table->integer('intDisplayOrder')->collation('utf8_general_ci');
                $table->char('chrDisplay',1)->default('Y')->collation('utf8_general_ci');
                $table->char('chrPublish',1)->default('Y')->collation('utf8_general_ci');
                $table->char('chrDelete',1)->default('N')->collation('utf8_general_ci');
                $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        Schema::table('video_gallery', function(Blueprint $table) 
        {
             
            $table->index('fkIntAlbumId');

            $table->foreign('fkIntAlbumId')
            ->references('id')
            ->on('video_album');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('video_gallery');
    }
}
