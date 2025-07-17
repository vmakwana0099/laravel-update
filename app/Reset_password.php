<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reset_password extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'whmsc_id',
        'reset_flag',
        'remember_token',
        'created_at',
        'updated_at',
    ];

    // If you want to explicitly define the table name (optional)
    // protected $table = 'reset_passwords'; // or whatever your table is

    // If you don’t want timestamps (optional, if your table doesn’t have them)
    // public $timestamps = false;
}
