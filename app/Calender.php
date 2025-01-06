<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;
class Calender extends Model{
	static function get_data_for_calender($searchCalendarFilter=false){
  	$response = false;
		$data = '';
		$query = '';
		$query = DB::table('contactus_lead')->select('*');
		if(!empty($searchCalendarFilter)){
			$data = $query->whereRaw("(contactus_lead.name LIKE '%$searchCalendarFilter%')")->get();
		}else{
			$data = $query->where('chr_delete','=','N')->get();
		}
		if(!empty($data)){
			$response = $data;
		}
		return $response;
  }
}
