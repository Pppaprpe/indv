<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    protected $table = 'indv_user_logs';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'action', 'description'];

    function user() 
    {
    	return $this->belongsTo('App\User', 'user_id');
    }

    function status() 
    {
    	return $this->belongsTo('App\Models\Action', 'action');
    }
}
