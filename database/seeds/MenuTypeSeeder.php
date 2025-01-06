<?php
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Helpers\MyLibrary;
use App\Http\Traits\slug;
class MenuTypeSeeder extends Seeder 
{
	use slug;
	/**
	* Run the database seeds.
	*
	* @return void
	*/
	public function run() 
	{
		$moduleCode = DB::table('module')->select('id')->where('varModuleName','menu-type')->first();	
		DB::table('menu_type')->insert([
			'varTitle'  => 'Header Menu',
			'intAliasId' => MyLibrary::insertAlias(slug::create_slug('Header Menu')[0],$moduleCode->id),
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);
		DB::table('menu_type')->insert([
			'varTitle'  => 'Footer Menu',
			'intAliasId' => MyLibrary::insertAlias(slug::create_slug('Footer Menu')[0],$moduleCode->id),
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);

	}

}