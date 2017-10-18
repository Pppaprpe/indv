<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use DB;
use PDF;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingLog;
use App\Models\UserLog;
use App\Models\AdminLog;

class PDFPrintController extends Controller
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

    public function bookingPrint($sortID)
    {
    	$booking = Booking::join('indv_profiles', 'indv_bookings.user_id', '=', 'indv_profiles.user_id')
                            ->join('indv_student_classes', 'indv_profiles.student_class', '=', 'indv_student_classes.id')
                            ->select(DB::raw('*, indv_student_classes.name as student_class, indv_bookings.id as booking_id'))
                            ->where('indv_bookings.booking_status', '=', 1)
                            ->where('indv_bookings.booking_sort', '=', $sortID)
                            ->orderBy('indv_bookings.startdate', 'ASC')
                            ->orderBy('indv_bookings.updated_at', 'DESC')
                            ->get();
        $data['check'] = $sortID;

        view()->share('bookings', $booking);

        $pdf = PDF::loadView('backend.bookings.print', $data);
        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream();
    }

    public function bookingReportPrint(Request $request)
    {   
        $start = date('Y-m-d', strtotime($request->get('startdate')));
        $end = date('Y-m-d', strtotime($request->get('enddate')));
        $option = $request->get('option');
        $sort = $request->get('sort');
        $data['option'] = $option;
        $data['sort'] = $sort;

        if ($sort == 0) {
            switch ($option) {
                case 0:
                    $booking = BookingLog::join('indv_bookings', 'indv_booking_logs.booking_id', '=', 'indv_bookings.id')
                                    ->join('indv_profiles', 'indv_booking_logs.user_id', '=', 'indv_profiles.user_id')
                                    ->join('indv_student_classes', 'indv_profiles.student_class', '=', 'indv_student_classes.id')
                                    ->select(DB::raw('*, indv_student_classes.name as student_class, indv_booking_logs.booking_id as booking_id'))
                                    ->whereBetween('startdate', array($start, $end))
                                    ->orderBy('startdate', 'ASC')
                                    ->paginate(25);
                    break;
                case 1:
                    $booking = BookingLog::join('indv_bookings', 'indv_booking_logs.booking_id', '=', 'indv_bookings.id')
                                    ->join('indv_profiles', 'indv_booking_logs.user_id', '=', 'indv_profiles.user_id')
                                    ->join('indv_student_classes', 'indv_profiles.student_class', '=', 'indv_student_classes.id')
                                    ->select(DB::raw('*, indv_student_classes.name as student_class, indv_booking_logs.booking_id as booking_id'))
                                    ->where('booking_status', '=', 1)
                                    ->whereBetween('startdate', array($start, $end))
                                    ->orderBy('startdate', 'ASC')
                                    ->paginate(25);
                    break;
                case 2:
                    $booking = BookingLog::join('indv_bookings', 'indv_booking_logs.booking_id', '=', 'indv_bookings.id')
                                    ->join('indv_profiles', 'indv_booking_logs.user_id', '=', 'indv_profiles.user_id')
                                    ->join('indv_student_classes', 'indv_profiles.student_class', '=', 'indv_student_classes.id')
                                    ->select(DB::raw('*, indv_student_classes.name as student_class, indv_booking_logs.booking_id as booking_id'))
                                    ->where('booking_status', '=', 2)
                                    ->whereBetween('startdate', array($start, $end))
                                    ->orderBy('startdate', 'ASC')
                                    ->paginate(25);
                    break;
                case 3:
                    $booking = BookingLog::join('indv_bookings', 'indv_booking_logs.booking_id', '=', 'indv_bookings.id')
                                    ->join('indv_profiles', 'indv_booking_logs.user_id', '=', 'indv_profiles.user_id')
                                    ->join('indv_student_classes', 'indv_profiles.student_class', '=', 'indv_student_classes.id')
                                    ->select(DB::raw('*, indv_student_classes.name as student_class, indv_booking_logs.booking_id as booking_id'))
                                    ->where('booking_status', '=', 3)
                                    ->whereBetween('startdate', array($start, $end))
                                    ->orderBy('startdate', 'ASC')
                                    ->paginate(25);
                    break;
                case 4:
                    $booking = BookingLog::join('indv_bookings', 'indv_booking_logs.booking_id', '=', 'indv_bookings.id')
                                    ->join('indv_profiles', 'indv_booking_logs.user_id', '=', 'indv_profiles.user_id')
                                    ->join('indv_student_classes', 'indv_profiles.student_class', '=', 'indv_student_classes.id')
                                    ->select(DB::raw('*, indv_student_classes.name as student_class, indv_booking_logs.booking_id as booking_id'))
                                    ->where('booking_status', '=', 4)
                                    ->whereBetween('startdate', array($start, $end))
                                    ->orderBy('startdate', 'ASC')
                                    ->paginate(25);
                    break;
                default:
                    $booking = BookingLog::join('indv_bookings', 'indv_booking_logs.booking_id', '=', 'indv_bookings.id')
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
                    $booking = BookingLog::join('indv_bookings', 'indv_booking_logs.booking_id', '=', 'indv_bookings.id')
                                    ->join('indv_profiles', 'indv_booking_logs.user_id', '=', 'indv_profiles.user_id')
                                    ->join('indv_student_classes', 'indv_profiles.student_class', '=', 'indv_student_classes.id')
                                    ->select(DB::raw('*, indv_student_classes.name as student_class, indv_booking_logs.booking_id as booking_id'))
                                    ->where('booking_sort', '=', $sort)
                                    ->whereBetween('startdate', array($start, $end))
                                    ->orderBy('startdate', 'ASC')
                                    ->paginate(25);
                    break;
                case 1:
                    $booking = BBookingLog::join('indv_bookings', 'indv_booking_logs.booking_id', '=', 'indv_bookings.id')
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
                    $booking = BookingLog::join('indv_bookings', 'indv_booking_logs.booking_id', '=', 'indv_bookings.id')
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
                    $booking = BookingLog::join('indv_bookings', 'indv_booking_logs.booking_id', '=', 'indv_bookings.id')
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
                    $booking = BookingLog::join('indv_bookings', 'indv_booking_logs.booking_id', '=', 'indv_bookings.id')
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
                    $booking = BookingLog::join('indv_bookings', 'indv_booking_logs.booking_id', '=', 'indv_bookings.id')
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

        view()->share('bookings', $booking);

        $pdf = PDF::loadView('backend.bookings.printreport', $data);
        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream();
    }

    public function logPrint($logID)
    {
    	if ($logID == 1) {
    		$log = BookingLog::orderBy('created_at', 'ASC')->get();

    		view()->share('logs', $log);

            $pdf = PDF::loadView('backend.logs.bookingprint');
            $pdf->setPaper('A4', 'portrait');

            return $pdf->stream();
    	} else if ($logID == 2) {
    		$log = UserLog::join('indv_profiles', 'indv_profiles.user_id', '=', 'indv_user_logs.user_id')
    							->join('indv_student_classes', 'indv_student_classes.id', '=', 'indv_profiles.student_class')
    							->select(DB::raw('*, indv_student_classes.name as student_class'))
    							->orderBy('indv_user_logs.created_at', 'ASC')
    							->get();

    		view()->share('logs', $log);

            $pdf = PDF::loadView('backend.logs.userprint');
            $pdf->setPaper('A4', 'portrait');

            return $pdf->stream();
    	} else {
    		$log = AdminLog::orderBy('created_at', 'ASC')->get();

    		view()->share('logs', $log);

            $pdf = PDF::loadView('backend.logs.adminprint');
            $pdf->setPaper('A4', 'portrait');

            return $pdf->stream();
    	}
    }
}
