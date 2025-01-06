<?php
use Illuminate\Database\Seeder;
use Carbon\Carbon;
class ContactinfoTableSeeder extends Seeder {
	/**
	* Run the database seeds.
	*
	* @return void
	*/
	public function run() 
	{
		DB::table('contact_info')->insert([
			'varTitle' => 'Netclues Cayman',
			'varEmail'=>serialize([0 => 'testbynetclues@gmail.com']),
			'varPhoneNo'=> serialize([0 => '3123445478']),
			'intDisplayOrder' => 1,
			'fkIntImgId' => null,
			'txtAddress'=> '786 Northwest Point Road, West Bay, PO Box 812 Grand Cayman, Cayman Island',
			'varOpeningHours'	=> 'Sun -Sat: 8:00 To 17:00',
			'chrLatitude'=> '19.285937101392125',
			'chrLongitude'=> '-81.263626813888550',
			'created_at'=>Carbon::now(),
			'updated_at'=>Carbon::now(),
			'chrIsPrimary' => 'Y',
			'chrPublish' => 'Y',
			'chrDelete' => 'N'
		]);

		DB::table('contact_info')->insert([
			'varTitle' => 'Netclues India',
			'varEmail'=>serialize( [0 => 'testbynetclues@gmail.com']),
			'varPhoneNo'=> serialize([0 => '3123445478']),
			'intDisplayOrder' => 2,
			'fkIntImgId' => null,
			'txtAddress'=> ' 501, Mauryansh Elanza, 5th Floor, Nr Parekh Hospital, Nr Shyamal Cross Road, Satellite, Ahmedabad, Gujarat 380015',
			'varOpeningHours'	=> 'Mon- Sat: 10.00 AM To 07:00 PM',
			'chrLatitude'=> '23.0225',
			'chrLongitude'=> '72.5714',
			'created_at'=>Carbon::now(),
			'updated_at'=>Carbon::now(),
			'chrIsPrimary' => 'N',
			'chrPublish' => 'Y',
			'chrDelete' => 'N'
		]);

	}
	
}