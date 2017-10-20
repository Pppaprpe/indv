<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Storage\LogRepository;
use App\Repositories\Storage\TurnRepository;
use App\Repositories\Storage\BookingRepository;
use App\Models\Booking;
use App\Models\BookingTurn;
use App\Models\BookingPeriod;
use App\Models\Syllabus;

class FlightBookingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'profile.check']);
    }
    
    public function index(Booking $booking)
    {
        $data['booking'] = $booking->where('user_id', '=', Auth::id())
                                    ->where('booking_sort', '=', 1)
                                    ->where('booking_status', '!=', 6)
                                    ->orderBy('updated_at', 'DESC')
                                    ->get();
        $data['current'] = $booking->where('user_id', '=', Auth::id())
                                    ->where('booking_sort', '=', 1)
                                    ->orderBy('updated_at', 'DESC')
                                    ->first();

    	return view('frontend.flight.mybooking', $data);
    }

    public function getBooking()
    {
        $data['period'] = BookingPeriod::get();
        $data['course'] = Syllabus::get();

    	return view('frontend.flight.booking', $data);
    }

    public function postBooking(Request $request, LogRepository $log, TurnRepository $turn)
    {
        $id = Auth::id();

    	$rules = [
            'user_id'           =>  '',
            'booking_sort'      =>  '',
            'booking_period'    =>  'required',
            'booking_status'    =>  '',
            'startdate'         =>  'required',
            'enddate'           =>  'required',
            'syllabus'          =>  'required'
        ];
        $this->validate($request, $rules);
        $request['user_id'] = $id;
        $request['booking_sort'] = 1;
        $request['booking_status'] = 1;

        $booking = Booking::create(array_only($request->all(), array_keys($rules)));
        $log->createBookingLog($id, $booking->id, 1, null);
        $turn->createTurn($id, $booking->id);

        return redirect()->route('frontend.flight.mybooking');
    }

    public function getReBooking($bookingID)
    {
        $data['booking'] = Booking::findOrFail($bookingID);
    	$data['period'] = BookingPeriod::get();
        $data['course'] = Syllabus::get();

        return view('frontend.flight.rebooking', $data);
    }

    public function postReBooking($bookingID, Request $request, LogRepository $log, TurnRepository $turn)
    {
    	$id = Auth::id();

        $rules = [
            'booking_period'    =>  'required',
            'booking_status'    =>  '',
            'startdate'         =>  'required',
            'enddate'           =>  'required',
            'syllabus'          =>  'required'
        ];
        $this->validate($request, $rules);
        $request['booking_status'] = 2;

        $booking = Booking::findOrFail($bookingID);
        $booking->update(array_only($request->all(), array_keys($rules)));
        $log->createBookingLog($id, $bookingID, 2, null);
        $turn->updateTurn($bookingID);

        return redirect()->route('frontend.flight.mybooking');
    }

    public function cancelBooking($bookingID, BookingRepository $booking, LogRepository $log)
    {
    	$booking->cancelBooking($bookingID);
        $log->createBookingLog(Auth::id(), $bookingID, 5, null);

        return redirect()->route('frontend.flight.mybooking');
    }
}
