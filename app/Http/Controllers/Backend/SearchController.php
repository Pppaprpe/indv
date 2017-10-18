<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingLog;

class SearchController extends Controller
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

    public function bookingSearch(Request $request)
    {
    	$start = date('Y-m-d', strtotime($request->get('startdate')));
    	$end = date('Y-m-d', strtotime($request->get('enddate')));
        $data['booking'] = Booking::join('indv_profiles', 'indv_bookings.user_id', '=', 'indv_profiles.user_id')
                                	->join('indv_student_classes', 'indv_profiles.student_class', '=', 'indv_student_classes.id')
                                	->select(DB::raw('*, indv_student_classes.name as student_class, indv_bookings.id as booking_id'))
                                	->whereBetween('startdate', array($start, $end))
                                    ->orderBy('startdate', 'ASC')
                                    ->paginate(25);

        return view('backend.bookings.list', $data);
    }

    public function bookingReportSearch(Request $request)
    {
    	$start = date('Y-m-d', strtotime($request->get('startdate')));
        $end = date('Y-m-d', strtotime($request->get('enddate')));
        $option = $request->get('option');
        $sort = $request->get('sort');

        if ($sort == 0) {
            switch ($option) {
                case 0:
                    $data['booking'] = BookingLog::join('indv_bookings', 'indv_booking_logs.booking_id', '=', 'indv_bookings.id')
                                    ->join('indv_profiles', 'indv_booking_logs.user_id', '=', 'indv_profiles.user_id')
                                    ->join('indv_student_classes', 'indv_profiles.student_class', '=', 'indv_student_classes.id')
                                    ->select(DB::raw('*, indv_student_classes.name as student_class, indv_booking_logs.booking_id as booking_id'))
                                    ->whereBetween('startdate', array($start, $end))
                                    ->orderBy('startdate', 'ASC')
                                    ->paginate(25);
                    break;
                case 1:
                    $data['booking'] = BookingLog::join('indv_bookings', 'indv_booking_logs.booking_id', '=', 'indv_bookings.id')
                                    ->join('indv_profiles', 'indv_booking_logs.user_id', '=', 'indv_profiles.user_id')
                                    ->join('indv_student_classes', 'indv_profiles.student_class', '=', 'indv_student_classes.id')
                                    ->select(DB::raw('*, indv_student_classes.name as student_class, indv_booking_logs.booking_id as booking_id'))
                                    ->where('booking_status', '=', 1)
                                    ->whereBetween('startdate', array($start, $end))
                                    ->orderBy('startdate', 'ASC')
                                    ->paginate(25);
                    break;
                case 2:
                    $data['booking'] = BookingLog::join('indv_bookings', 'indv_booking_logs.booking_id', '=', 'indv_bookings.id')
                                    ->join('indv_profiles', 'indv_booking_logs.user_id', '=', 'indv_profiles.user_id')
                                    ->join('indv_student_classes', 'indv_profiles.student_class', '=', 'indv_student_classes.id')
                                    ->select(DB::raw('*, indv_student_classes.name as student_class, indv_booking_logs.booking_id as booking_id'))
                                    ->where('booking_status', '=', 2)
                                    ->whereBetween('startdate', array($start, $end))
                                    ->orderBy('startdate', 'ASC')
                                    ->paginate(25);
                    break;
                case 3:
                    $data['booking'] = BookingLog::join('indv_bookings', 'indv_booking_logs.booking_id', '=', 'indv_bookings.id')
                                    ->join('indv_profiles', 'indv_booking_logs.user_id', '=', 'indv_profiles.user_id')
                                    ->join('indv_student_classes', 'indv_profiles.student_class', '=', 'indv_student_classes.id')
                                    ->select(DB::raw('*, indv_student_classes.name as student_class, indv_booking_logs.booking_id as booking_id'))
                                    ->where('booking_status', '=', 3)
                                    ->whereBetween('startdate', array($start, $end))
                                    ->orderBy('startdate', 'ASC')
                                    ->paginate(25);
                    break;
                case 4:
                    $data['booking'] = BookingLog::join('indv_bookings', 'indv_booking_logs.booking_id', '=', 'indv_bookings.id')
                                    ->join('indv_profiles', 'indv_booking_logs.user_id', '=', 'indv_profiles.user_id')
                                    ->join('indv_student_classes', 'indv_profiles.student_class', '=', 'indv_student_classes.id')
                                    ->select(DB::raw('*, indv_student_classes.name as student_class, indv_booking_logs.booking_id as booking_id'))
                                    ->where('booking_status', '=', 4)
                                    ->whereBetween('startdate', array($start, $end))
                                    ->orderBy('startdate', 'ASC')
                                    ->paginate(25);
                    break;
                default:
                    $data['booking'] = BookingLog::join('indv_bookings', 'indv_booking_logs.booking_id', '=', 'indv_bookings.id')
                                    ->join('indv_profiles', 'indv_booking_logs.user_id', '=', 'indv_profiles.user_id')
                                    ->join('indv_student_classes', 'indv_profiles.student_class', '=', 'indv_student_classes.id')
                                    ->select(DB::raw('*, indv_student_classes.name as student_class, indv_booking_logs.booking_id as booking_id'))
                                    ->whereBetween('startdate', array($start, $end))
                                    ->orderBy('startdate', 'ASC')
                                    ->paginate(25);
                    break;
            }
        } else {
            switch ($option) {
                case 0:
                    $data['booking'] = BookingLog::join('indv_bookings', 'indv_booking_logs.booking_id', '=', 'indv_bookings.id')
                                    ->join('indv_profiles', 'indv_booking_logs.user_id', '=', 'indv_profiles.user_id')
                                    ->join('indv_student_classes', 'indv_profiles.student_class', '=', 'indv_student_classes.id')
                                    ->select(DB::raw('*, indv_student_classes.name as student_class, indv_booking_logs.booking_id as booking_id'))
                                    ->where('booking_sort', '=', $sort)
                                    ->whereBetween('startdate', array($start, $end))
                                    ->orderBy('startdate', 'ASC')
                                    ->paginate(25);
                    break;
                case 1:
                    $data['booking'] = BBookingLog::join('indv_bookings', 'indv_booking_logs.booking_id', '=', 'indv_bookings.id')
                                    ->join('indv_profiles', 'indv_booking_logs.user_id', '=', 'indv_profiles.user_id')
                                    ->join('indv_student_classes', 'indv_profiles.student_class', '=', 'indv_student_classes.id')
                                    ->select(DB::raw('*, indv_student_classes.name as student_class, indv_booking_logs.booking_id as booking_id'))
                                    ->where('booking_sort', '=', $sort)
                                    ->where('booking_status', '=', 1)
                                    ->whereBetween('startdate', array($start, $end))
                                    ->orderBy('startdate', 'ASC')
                                    ->paginate(25);
                    break;
                case 2:
                    $data['booking'] = BookingLog::join('indv_bookings', 'indv_booking_logs.booking_id', '=', 'indv_bookings.id')
                                    ->join('indv_profiles', 'indv_booking_logs.user_id', '=', 'indv_profiles.user_id')
                                    ->join('indv_student_classes', 'indv_profiles.student_class', '=', 'indv_student_classes.id')
                                    ->select(DB::raw('*, indv_student_classes.name as student_class, indv_booking_logs.booking_id as booking_id'))
                                    ->where('booking_sort', '=', $sort)
                                    ->where('booking_status', '=', 2)
                                    ->whereBetween('startdate', array($start, $end))
                                    ->orderBy('startdate', 'ASC')
                                    ->paginate(25);
                    break;
                case 3:
                    $data['booking'] = BookingLog::join('indv_bookings', 'indv_booking_logs.booking_id', '=', 'indv_bookings.id')
                                    ->join('indv_profiles', 'indv_booking_logs.user_id', '=', 'indv_profiles.user_id')
                                    ->join('indv_student_classes', 'indv_profiles.student_class', '=', 'indv_student_classes.id')
                                    ->select(DB::raw('*, indv_student_classes.name as student_class, indv_booking_logs.booking_id as booking_id'))
                                    ->where('booking_sort', '=', $sort)
                                    ->where('booking_status', '=', 3)
                                    ->whereBetween('startdate', array($start, $end))
                                    ->orderBy('startdate', 'ASC')
                                    ->paginate(25);
                    break;
                case 4:
                    $data['booking'] = BookingLog::join('indv_bookings', 'indv_booking_logs.booking_id', '=', 'indv_bookings.id')
                                    ->join('indv_profiles', 'indv_booking_logs.user_id', '=', 'indv_profiles.user_id')
                                    ->join('indv_student_classes', 'indv_profiles.student_class', '=', 'indv_student_classes.id')
                                    ->select(DB::raw('*, indv_student_classes.name as student_class, indv_booking_logs.booking_id as booking_id'))
                                    ->where('booking_sort', '=', $sort)
                                    ->where('booking_status', '=', 4)
                                    ->whereBetween('startdate', array($start, $end))
                                    ->orderBy('startdate', 'ASC')
                                    ->paginate(25);
                    break;
                default:
                    $data['booking'] = BookingLog::join('indv_bookings', 'indv_booking_logs.booking_id', '=', 'indv_bookings.id')
                                    ->join('indv_profiles', 'indv_booking_logs.user_id', '=', 'indv_profiles.user_id')
                                    ->join('indv_student_classes', 'indv_profiles.student_class', '=', 'indv_student_classes.id')
                                    ->select(DB::raw('*, indv_student_classes.name as student_class, indv_booking_logs.booking_id as booking_id'))
                                    ->where('booking_sort', '=', $sort)
                                    ->whereBetween('startdate', array($start, $end))
                                    ->orderBy('startdate', 'ASC')
                                    ->paginate(25);
                    break;
            }
        }

        return view('backend.bookings.report', $data);
    }
}
