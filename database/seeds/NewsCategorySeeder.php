<?php
use Illuminate\Database\Seeder;
use Carbon\Carbon;
class NewsCategorySeeder extends Seeder {
	/**
	* Run the database seeds.
	*
	* @return void
	*/
	public function run() {
		DB::table('news_category')->insert([
			'name' => 'Tech',
			'display_order' => 0,
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);
		DB::table('news_category')->insert([
			'name' => 'Business',
			'display_order' => 1,
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);
		DB::table('news_category')->insert([
			'name' => 'Entertainment',
			'display_order' => 2,
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);
		DB::table('news_category')->insert([
			'name' => 'World',
			'display_order' => 3,
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);
		DB::table('news_category')->insert([
			'name' => 'Lifestyle',
			'display_order' => 4,
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);
	}
}