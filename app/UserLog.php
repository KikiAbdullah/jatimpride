<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    protected $table 	= 'user_logs';
    protected $fillable = [
    	'no',
    	'user_id',
        'action',
        'menu',
        'message',
    ];
}
