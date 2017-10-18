<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminLog extends Model
{
    protected $table = 'indv_admin_logs';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['admin_id', 'user_id', 'action', 'description'];

    function admin() 
    {
    	return $this->belongsTo('App\User', 'admin_id');
    }

    function user() 
    {
    	return $this->belongsTo('App\User', 'user_id');
    }

    function status() 
    {
    	return $this->belongsTo('App\Models\Action', 'action');
    }
}
