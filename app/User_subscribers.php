<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;
class User_subscribers extends Model {	
	protected $table = 'user_subscribers';
	protected $fillable = [
		'id',
		'email',
		'chr_publish',
		'ip_address',
		'chr_delete'
	];
	static function list_subscribers($start = false,$limit = false,$orderByFieldName = false,$orderTypeAscOrDesc = false,$searchFilter = false,$emailtypeFilter = false,$retunTotalRecords=false,$selectedIds=false) {
		$response = false;
		$data = '';
		$query = '';
		$query = DB::table('user_subscribers')
		->where('user_subscribers.chr_delete','=','N')
		->where('user_subscribers.chr_publish','=','Y')
		->groupBy('user_subscribers.id');
		if(!empty($orderByFieldName) && !empty($orderTypeAscOrDesc)){
			$data = $query->orderBy($orderByFieldName,$orderTypeAscOrDesc);
		}else{
			$data = $query->orderBy('user_subscribers.created_at','DESC');
		}
		if(!$retunTotalRecords){
			if(!empty($limit) && $limit > 0){
				$data = $query->skip($start)->take($limit);
			}
		}
		if(!empty($searchFilter)){
			$data = $query->whereRaw('(user_subscribers.email LIKE "%'.$searchFilter.'%")');
		}
		if($selectedIds!=false) {      
    	$data = $query->whereIn('user_subscribers.id', $selectedIds);
    }
		if(!empty($data)){
			$response = $data->get();
			return $response;
		}
	}
}