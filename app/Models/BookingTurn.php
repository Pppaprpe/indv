<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingTurn extends Model
{
    protected $table = 'indv_booking_turns';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'booking_id', 'turn'];

    function user() 
    {
    	return $this->belongsTo('App\User', 'user_id');
    }

    function booking() 
    {
    	return $this->belongsTo('App\Models\Booking', 'booking_id');
    }
}
