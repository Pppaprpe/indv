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
use App\Repositories\Storage\TurnRepository;
use App\User;
use App\Models\Profile;
use App\Models\Booking;
use App\Models\BookingTurn;
use App\Models\StudentClass;

class UserController extends Controller
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
        $data['user'] = User::leftJoin('indv_profiles', 'indv_users.id', '=', 'indv_profiles.user_id')
                            ->leftJoin('indv_student_classes', 'indv_profiles.student_class', '=', 'indv_student_classes.id')
                            ->select(DB::raw('*, indv_student_classes.name as student_class, indv_users.id as user_id'))
                            ->where('indv_users.user_role', '=', 1)
                            ->orderBy('indv_profiles.student_id', 'ASC')
                            ->paginate(25);

    	return view('backend.users.list', $data);
    }

    public function getCreate()
    {
        $data['stdclass'] = StudentClass::orderBy('name', 'ASC')->get();
        $data['backUrl'] = Session::get('listUrl');

    	return view('backend.users.create', $data);
    }

    public function postCreate(Request $request, LogRepository $log)
    {
    	$rules = [
            'firstname'     =>  'required',
            'lastname'      =>  'required',
            'email'         =>  'required|email|unique:indv_users',
            'password'      =>  'required|confirmed',
            'mobile_no'     =>  'required|numeric|unique:indv_profiles',
            'student_id'    =>  'required|unique:indv_profiles',
            'student_class' =>  'required',
            'user_id'       =>  '',
            'user_role'     =>  '',
            'user_status'   =>  ''
        ];

        $this->validate($request, $rules);
        $request['password'] = bcrypt($request->get('password'));
        $request['user_role'] = 1;
        $request['user_status'] = 1;
        $user = User::create(array_only($request->all(), array_keys($rules)));

        $request['user_id'] = $user->id;
        $profile = Profile::create(array_only($request->all(), array_keys($rules)));
        $log->createUserLog($user->id, 4, 'by admin: ' . Auth::user()->firstname);
        $log->createAdminLog(Auth::id(), $user->id, 1, null);
        $url = Session::get('createUrl');

        return redirect($url);
    }

    public function getEdit($userID)
    {
        $data['user'] = User::findOrFail($userID);
        $data['profile'] = Profile::where('user_id', '=', $userID)->first();
        $data['stdclass'] = StudentClass::orderBy('name', 'ASC')->get();
        $data['backUrl'] = Session::get('listUrl');

        return view('backend.users.edit', $data);
    }

    public function postEdit($userID, Request $request, LogRepository $log)
    {
        $profile = Profile::where('user_id', '=', $userID)->first();

    	$rules = [
            'firstname'     =>  'required',
            'lastname'      =>  'required',
            'email'         =>  'required|email|unique:indv_users,email,' . $userID,
            'mobile_no'     =>  'required|numeric|unique:indv_profiles,mobile_no,' . $profile->id,
            'student_id'    =>  'required|unique:indv_profiles,student_id,' . $profile->id,
            'student_class' =>  'required'
        ];

        $this->validate($request, $rules);
        $user = User::findOrFail($userID);
        $user->update(array_only($request->all(), array_keys($rules)));
        $profile->update(array_only($request->all(), array_keys($rules)));
        $log->createAdminLog(Auth::id(), $userID, 2, null);
        $url = Session::get('listUrl');

        return redirect($url);
    }

    public function changeStatus($userID, $statusID, LogRepository $log)
    {
    	$user = User::findOrFail($userID);
        $user->update(['user_status' => $statusID]);
        if ($statusID == 1) {
            $log->createAdminLog(Auth::id(), $userID, 7, null);
        } else {
            $log->createAdminLog(Auth::id(), $userID, 6, null);
        }

        return redirect()->back();        
    }

    public function delete($userID, LogRepository $log, BookingRepository $booking, TurnRepository $turn)
    {
        $user = User::findOrFail($userID);
        $profile = Profile::where('user_id', '=', $userID)->first();

        if ($profile) {
            $log->createAdminLog(Auth::id(), null, 3, 'student: ' . $profile->student_id);
            $profile->delete();
        }

        // Delete User Data
        $user->delete();

        // Delete Log Data
        $log->deleteUser($userID);

        // Delete Booking Data
        $booking->deleteBooking($userID);

        // Delete Booking Turn Data
        $turn->deleteTurn($userID);

        $url = Session::get('listUrl');

        return redirect($url);
    }
}
