<?php
namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use DB;

class Reset_password extends Authenticatable {
	use EntrustUserTrait;
	/**
  * The attributes that are mass assignable.
  *
  * @var array
  */
         
	protected $fillable = [
		'whmsc_id','reset_flag','remember_token','created_at','updated_at'
	];
	

	/**
  * The attributes that should be hidden for arrays.
  *
  * @var array
  */
	

}