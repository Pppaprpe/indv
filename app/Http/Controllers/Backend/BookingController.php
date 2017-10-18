<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

use DB;
use Auth;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Storage\LogRepository;
use App\Repositories\Storage\BookingRepository;
use App\User;
use App\Models\Booking;
use App\Models\BookingStatus;

class BookingController extends Controller
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
    
    public function index()
    {
        $data['booking'] = Booking::join('indv_profiles', 'indv_bookings.user_id', '=', 'indv_profiles.user_id')
                                ->join('indv_student_classes', 'indv_profiles.student_class', '=', 'indv_student_classes.id')
                                ->select(DB::raw('*, indv_student_classes.name as student_class, indv_bookings.id as booking_id'))
                                ->where('indv_bookings.booking_status', '<', 6)
                                ->orderBy('indv_bookings.booking_status', 'ASC')
                                ->orderBy('indv_bookings.updated_at', 'DESC')
                                ->paginate(25);

    	return view('backend.bookings.list', $data);
    }

    public function getEdit($bookingID)
    {
    	$data['booking'] = Booking::findOrFail($bookingID);
        $data['status'] = BookingStatus::where([['id', '>', 2], ['id', '<', 5]])->get();
        $data['bookingJSON'] = $data['booking']->toJson();
        $userID = $data['booking']->user_id;
        $data['user'] = User::join('indv_profiles', 'indv_users.id', '=', 'indv_profiles.user_id')
                            ->join('indv_student_classes', 'indv_profiles.student_class', '=', 'indv_student_classes.id')
                            ->where('indv_users.id', '=', $userID)
                            ->select(DB::raw('*, indv_student_classes.name as student_class'))
                            ->first();
        $data['backUrl'] = Session::get('listUrl');

        return view('backend.bookings.edit', $data);
    }

    public function postEdit($bookingID, Request $request, LogRepository $log)
    {
        $id = Auth::id();
    	$status = $request->get('booking_status');
        $booking = Booking::findOrFail($bookingID);
        
        if ($status == 3) {
            if ($booking->booking_sort == 2) {
                $booking->update([
                    'booking_status'    =>  $status,
                    'confirmdate'       =>  $request->get('confirmdate')
                ]);
            } else {
                $booking->update([
                    'booking_status'    =>  $status,
                    'confirmdate'       =>  $booking->startdate
                ]);
            }
            $log->createBookingLog($id, $bookingID, 3, null);
        } else if ($status == 4) {
            $booking->update(['booking_status' => $status]);
            $log->createBookingLog($id, $bookingID, 4, null);
        }
        $url = Session::get('listUrl');

        return redirect($url);
    }

    public function acceptBooking($bookingID, LogRepository $log)
    {
        $booking = Booking::findOrFail($bookingID);
        $booking->update(['booking_status' => 2]);
        $log->createBookingLog(Auth::id(), $bookingID, 2, null);
        $url = Session::get('listUrl');

        return redirect($url);
    }

    public function cancelBooking($bookingID, LogRepository $log, BookingRepository $booking)
    {
    	$booking->cancelBooking($bookingID);
        $log->createBookingLog(Auth::id(), $bookingID, 5, null);
        $url = Session::get('listUrl');

        return redirect($url);
    }
}
