<?php

namespace App\Repositories\Interfaces;

interface TurnRepositoryInterface
{
	public function createTurn($userID, $bookingID);
	public function updateTurn($bookingID);
	public function deleteTurn($userID);
}