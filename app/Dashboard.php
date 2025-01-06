<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;
class Dashboard extends Model{
	/**
  * The attributes that are mass assignable.
	*
	* @var array
	*/
	static function get_contact_leads() {		
		return DB::table('contactus_lead')
	  ->select('contactus_lead.*')
		->where('chr_delete', '=', 'N')
		->orderBy('created_at','DESC')
		->take(5)
		->get();
	}
	static function get_faqs() {		
	  return DB::table('faq')
		->select('faq.*')
		->where('chr_delete', '=', 'N')
		->orderBy('order','ASC')
		->take(5)
		->get();
	}
}