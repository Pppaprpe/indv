<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\UserLog;
use App\Models\BookingLog;
use App\Models\AdminLog;

class LogController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
	    $this->middleware(['auth', 'auth.itadmin']);
	}
	
    public function bookingLog()
    {
    	$data['log'] = BookingLog::orderBy('created_at', 'ASC')->paginate(25);

    	return view('backend.logs.booking', $data);
    }

    public function userLog()
    {
    	$data['log'] = UserLog::join('indv_profiles', 'indv_profiles.user_id', '=', 'indv_user_logs.user_id')
    							->join('indv_student_classes', 'indv_student_classes.id', '=', 'indv_profiles.student_class')
    							->select(DB::raw('*, indv_student_classes.name as student_class'))
    							->orderBy('indv_user_logs.created_at', 'ASC')
    							->paginate(25);

    	return view('backend.logs.user', $data);
    }

    public function adminLog()
    {
    	$data['log'] = AdminLog::orderBy('created_at', 'ASC')->paginate(25);

    	return view('backend.logs.admin', $data);
    }
}
