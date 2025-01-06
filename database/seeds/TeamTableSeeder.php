<?php
use Illuminate\Database\Seeder;
use Carbon\Carbon;
class TeamTableSeeder extends Seeder {
	/**
  * Run the database seeds.
  *
  * @return void
  */
	public function run() {
		DB::table('team')->insert([
			'intAliasId'=> 0,
			'varTitle' => 'Everett McCoy',
			'varTagLine' => 'Project lead',
			'fkIntImgId' => '0',
			'intDisplayOrder' => 1,
			'txtDescription' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam massa ligula, scelerisque sit amet aliquet in, consequat vitae lacus. Nullam pellentesque libero purus, ut ullamcorper felis maximus sit amet. Pellentesque urna magna, gravida sed tincidunt eget, pharetra vitae quam. Morbi dictum condimentum elit, vitae varius odio bibendum at. Nulla vehicula velit</p> ',
			'varEmail'=> 'testbynetclues@gmail.com',
			'varPhoneNo'=> '3123445478',
			'textAddress'=> 'George town, Cayman Islands',
			'txtSocialLinks' =>serialize(['facebook'=>'http://www.facebook']),
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		]);
		
	}
}