<?php
use Illuminate\Database\Seeder;
use Carbon\Carbon;
class FaqTableSeeder extends Seeder{
		/**
		 * Run the database seeds.
		 *
		 * @return void
		 */
		public function run(){
			DB::table('faq')->insert([
			'varTitle'=>'Who are we?',
			'intDisplayOrder'=> 1,
			'txtDescription'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
			]);
		}
}
