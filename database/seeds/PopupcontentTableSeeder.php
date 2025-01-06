<?php
use Illuminate\Database\Seeder;
use Carbon\Carbon;
class PopupcontentTableSeeder extends Seeder {
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run() {
    DB::table('pop_up_content')->insert([
      'varTitle'  => 'Vacation time!',
      'txtDescription' => 'Cayman Scents will be closed for summer vacation from July 24th until August 15th.',
      'chrPublish' => 'Y',
      'chrDelete' => 'N',
      'dtStartDateTime'=> Carbon::today()->format('Y-m-d'),
      'dtEndDateTime'=> Carbon::today()->format('Y-m-d'),
      'created_at'=> Carbon::now(),
      'updated_at'=> Carbon::now()
    ]);
  }
}