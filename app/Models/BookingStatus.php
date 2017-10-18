<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingStatus extends Model
{
    protected $table = 'indv_booking_statuses';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
}
