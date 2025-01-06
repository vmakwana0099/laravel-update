<?php
namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use DB;

class Front_user extends Authenticatable {
	use EntrustUserTrait;
	/**
  * The attributes that are mass assignable.
  *
  * @var array
  */
         
	protected $fillable = [
		'whmsc_id','currency','currency_code','country_code','name','email','password','provider','provider_id','varimage','remember_token','varIpAddress'
	];
	

	/**
  * The attributes that should be hidden for arrays.
  *
  * @var array
  */
	protected $hidden = [
		'password', 'remember_token',
	];

}