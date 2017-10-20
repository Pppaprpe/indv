<?php

namespace App\Repositories\Storage;

use App\Models\BookingTurn;
use App\Repositories\Interfaces\TurnRepositoryInterface;

class TurnRepository implements TurnRepositoryInterface
{
	public function createTurn($userID, $bookingID)
	{
		$turn = new BookingTurn();

		$turn->create([
            'user_id'       =>  $userID, 
            'booking_id'    =>  $bookingID,
            'turn'          =>  1
        ]);
	}
	
	public function updateTurn($bookingID)
	{
		$turn = BookingTurn::where('booking_id', '=', $bookingID)->first();

		$turn->update([
			'turn'	=>	$turn + 1
		]);
	}

	public function deleteTurn($userID)
	{
		$turn = BookingTurn::where('user_id', '=', $userID)->get();
		
		if ($turn) {
			foreach ($turn as $t) {
				$t->delete();
			}
		}
	}
}