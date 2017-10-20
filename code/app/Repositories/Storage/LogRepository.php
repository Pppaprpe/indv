<?php

namespace App\Repositories\Storage;

use App\Models\UserLog;
use App\Models\BookingLog;
use App\Models\AdminLog;
use App\Repositories\Interfaces\LogRepositoryInterface;

class LogRepository implements LogRepositoryInterface
{
	
	public function createUserLog($userID, $actionID, $description)
	{
		$log = new UserLog();

		$log->create([
			'user_id'		=>	$userID,
			'action'		=>	$actionID,
			'description'	=>	$description
		]);
 	}

	public function createBookingLog($userID, $bookingID, $actionID, $description)
	{
		$log = new BookingLog();

		$log->create([
			'user_id'		=>	$userID,
			'booking_id'	=>	$bookingID,
			'action'		=>	$actionID,
			'description'	=>	$description
		]);
	}

	public function createAdminLog($adminID, $userID, $actionID, $description)
	{
		$log = new AdminLog();

		$log->create([
			'admin_id'		=>	$adminID,
			'user_id'		=>	$userID,
			'action'		=>	$actionID,
			'description'	=>	$description
		]);
	}

	public function deleteUser($userID)
	{
		$userLog = new UserLog();
		$bookingLog = new BookingLog();
		$adminLog = new AdminLog();

		$userLog = $userLog->where('user_id', '=', $userID)->get();
		$bookingLog = $bookingLog->where('user_id', '=', $userID)->get();
		$adminLog = $adminLog->where('user_id', '=', $userID)->get();

		if ($userLog) {
			foreach ($userLog as $uLog) {
				$uLog->delete();
			}
		}
		if ($bookingLog) {
			foreach ($bookingLog as $bLog) {
				$bLog->delete();
			}
		}
		if ($adminLog) {
			foreach ($adminLog as $aLog) {
				$aLog->delete();
			}
		}		
	}

	public function deleteAdmin($adminID)
	{
		$bookingLog = new BookingLog();
		$adminLog = new AdminLog();

		$bookingLog = $bookingLog->where('user_id', '=', $adminID)->get();
		$adminLog = $adminLog->where('admin_id', '=', $adminID)
							->orWhere('user_id', '=', $adminID)
							->get();

		if ($bookingLog) {
			foreach ($bookingLog as $bLog) {
				$bLog->delete();
			}
		}
		if ($adminLog) {
			foreach ($adminLog as $aLog) {
				$aLog->delete();
			}
		}		
	}
}