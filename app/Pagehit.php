<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;
class Pagehit extends Model {
	/**
	* The attributes that are mass assignable.
	*
	* @var array
	*/
	protected $table = 'page_hits';
	protected $fillable = [
		'id',	
		'fkIntAliasId',
		'varBrowserInfo',
		'isWeb',
		'varIpAddress',
		'created_at',
		'updated_at'
	];

	public static function getHits()
	{	
		return Pagehit::select(
		DB::raw("SUM(CASE  WHEN isWeb = 'N'  THEN 1 ELSE 0 END) AS mobile,
		SUM(CASE  WHEN isWeb = 'Y'  THEN 1 ELSE 0 END) AS web")
		)->first();
	}

	public static function getHitsCurrentMonth()
	{	
		return Pagehit::select(
		DB::raw("
		SUM(CASE  WHEN isWeb = 'N'  THEN 1 ELSE 0 END) AS mobile,
		SUM(CASE  WHEN isWeb = 'Y'  THEN 1 ELSE 0 END) AS web")
		)
		->whereRaw('MONTH(created_at) = MONTH(CURRENT_DATE())') 
		->whereRaw('YEAR(created_at) = YEAR(CURRENT_DATE())')
		->first();
	}

	public static function getHitsCurrentYear()
	{	
		return Pagehit::select(
		DB::raw("
		SUM(CASE  WHEN isWeb = 'N'  THEN 1 ELSE 0 END) AS mobile,
		SUM(CASE  WHEN isWeb = 'Y'  THEN 1 ELSE 0 END) AS web")
		)		
		->whereRaw('YEAR(created_at) = YEAR(CURRENT_DATE())')
		->first();
	}

	// public function pages()
	// {
	// 	return $this->hasOne('App\CmsPage','fkIntAliasId','intAliasId');
	// }

}
