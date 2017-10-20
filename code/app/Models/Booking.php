<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'indv_bookings';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'startdate', 'enddate', 'user_id', 'booking_period', 
    	'booking_sort', 'booking_status', 'syllabus'
    ];

    function user() 
    {
    	return $this->belongsTo('App\User', 'user_id');
    }

    function period() 
    {
    	return $this->belongsTo('App\Models\BookingPeriod', 'booking_period');
    }

    function sort() 
    {
    	return $this->belongsTo('App\Models\BookingSort', 'booking_sort');
    }

    function status() 
    {
    	return $this->belongsTo('App\Models\BookingStatus', 'booking_status');
    }

    function course() 
    {
    	return $this->belongsTo('App\Models\Syllabus', 'syllabus');
    }
}
