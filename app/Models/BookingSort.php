<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingSort extends Model
{
    protected $table = 'indv_booking_sorts';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
}
