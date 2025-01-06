<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateMessagesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id')->collation('utf8_general_ci');
            $table->integer('fk_record_id')->collation('utf8_general_ci')->default(0);
            $table->text('txt_message')->collation('utf8_general_ci')->nullable();
            $table->char('chr_publish', 1)->default('Y')->collation('utf8_general_ci');
            $table->char('chr_delete', 1)->default('N')->collation('utf8_general_ci');
            $table->char('chr_read', 1)->default('N')->collation('utf8_general_ci');
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
        Schema::drop('messages');
    }

}
