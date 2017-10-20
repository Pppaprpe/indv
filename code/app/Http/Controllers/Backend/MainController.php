<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use DB;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Storage\LogRepository;
use App\User;
use App\Models\Booking;
use App\Models\StudentClass;

class MainController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
	    $this->middleware('auth');
	}
	
    public function index(LogRepository $log)
    {
    	$today = date('Y-m-d');
    	$booking = Booking::get();

    	foreach ($booking as $b) {
			if ($b->startdate < $today) {
				$b->update(['booking_status' => 4]);
                $log->createBookingLog(Auth::id(), $b->id, 4, $b->user->firstname);
			}
    	}

        $data['booking'] = Booking::join('indv_profiles', 'indv_bookings.user_id', '=', 'indv_profiles.user_id')
                                ->select(DB::raw('*, indv_bookings.created_at as created_at, indv_bookings.updated_at as updated_at'))
                                ->whereNotBetween('indv_bookings.booking_status', [3, 4])
                                ->whereDate('indv_bookings.updated_at', '=', $today)
                                ->orderBy('indv_bookings.updated_at', 'DESC')
                                ->take(3)->get();
        $data['user'] = User::where('user_role', '=', 1)
                            ->whereDate('created_at', '=', $today)
                            ->orderBy('created_at', 'DESC')
                            ->take(3)->get();
        $data['stdclass'] = StudentClass::join('indv_profiles', 'indv_student_classes.id', '=', 'indv_profiles.student_class')
                                        ->join('indv_users', 'indv_profiles.user_id', '=', 'indv_users.id')
                                        ->whereDate('indv_profiles.created_at', '=', $today)
                                        ->orderBy('indv_profiles.created_at', 'DESC')
                                        ->take(3)->get();

    	return view('backend.home', $data);
    }
}
