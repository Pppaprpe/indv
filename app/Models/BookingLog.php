<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingLog extends Model
{
    protected $table = 'indv_booking_logs';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'action', 'booking_id'];

    function user() 
    {
    	return $this->belongsTo('App\User', 'user_id');
    }

    function status() 
    {
    	return $this->belongsTo('App\Models\BookingStatus', 'action');
    }

    function booking() 
    {
        return $this->belongsTo('App\Models\Booking', 'booking_id');
    }
}
