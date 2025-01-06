<?php
use Illuminate\Database\Seeder;
use Carbon\Carbon;
class TestimonialTableSeeder extends Seeder {
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run() {
  	DB::table('testimonials')->insert([
			'varTitle'  => 'NetQuick Admin',
			'txtDescription' => 'NetQuick aim is client satisfaction.',
      'intDisplayOrder' => 1,
			'dtStartDateTime' => Carbon::today()->format('Y-m-d'),
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);
  }
}