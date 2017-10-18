<?php

namespace App\Repositories\Interfaces;

interface LogRepositoryInterface 
{
	public function createUserLog($userID, $actionID, $description);
	public function createBookingLog($userID, $bookingID, $actionID, $description);
	public function createAdminLog($adminID, $userID, $actionID, $description);
	public function deleteUser($userID);
	public function deleteAdmin($adminID);
}