<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;
class MyLogs extends Model{
    protected $table = 'email_logs';
    protected $fillable = [
        'email_to',
        'email_from',
        'subject',
        'body',
        'status',
        'attachment_url',
        'error_message'
    ];
}
