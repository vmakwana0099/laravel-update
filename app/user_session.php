<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class user_session extends Model{
    protected $table = "front_session";
    public $timestamps = false;
    protected $fillable = ['id','user_id','ip_address','user_agent','payload','last_activity'];
}