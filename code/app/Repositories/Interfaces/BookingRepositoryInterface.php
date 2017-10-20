<?php

namespace App\Repositories\Interfaces;

interface BookingRepositoryInterface
{
	public function cancelBooking($bookingID);
	public function deleteBooking($userID);
}