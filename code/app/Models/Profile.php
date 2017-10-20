<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'indv_profiles';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'mobile_no', 'student_id', 'student_class'];

    function user() 
    {
    	return $this->belongsTo('App\User', 'user_id');
    }

    function studentclass() 
    {
    	return $this->belongsTo('App\Models\StudentClass', 'student_class');
    }
}
