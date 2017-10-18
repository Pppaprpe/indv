<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingPeriod extends Model
{
    protected $table = 'indv_booking_periods';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
}
