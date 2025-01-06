<?php
use Illuminate\Database\Seeder;
use Carbon\Carbon;
class SponserTableSeeder extends Seeder {
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run() {
  	DB::table('sponser')->insert([
			'name'  => 'Minisrty',
			'fk_image_id' => '',
			'link' => 'www.netclues.com',
			'display_order' => 1,
			'chr_publish' => 'Y',
			'chr_delete' => 'N',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);
  }
}