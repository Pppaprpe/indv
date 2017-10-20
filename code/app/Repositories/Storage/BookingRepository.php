<?php

namespace App\Repositories\Storage;

use App\Repositories\Interfaces\BookingRepositoryInterface;
use App\Models\Booking;

class BookingRepository implements BookingRepositoryInterface
{
	
	public function cancelBooking($bookingID)
	{
		$booking = Booking::findOrFail($bookingID);

        $booking->update(['booking_status'  =>  5]);
	}

	public function deleteBooking($userID)
	{
		$booking = Booking::where('user_id', '=', $userID)->get();

		if ($booking) {
			foreach ($booking as $b) {
				$b->delete();
			}
		}
	}
}