<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Storage\LogRepository;
use App\User;
use App\Models\Profile;
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
    
    public function index()
    {
    	return view('frontend.home');
    }

    public function getProfile()
    {
    	$data['user'] = Profile::where('user_id', '=', Auth::id())->first();
        $data['stdclass'] = StudentClass::orderBy('name', 'ASC')->get();

        return view('frontend.profile', $data);
    }

    public function postProfile(Request $request, LogRepository $log)
    {
        $id = Auth::id();
        $profile = Profile::where('user_id', '=', $id)->first();

        if ($profile) {
            $rules = [
                'mobile_no'     =>  'required|numeric|unique:indv_profiles,mobile_no,' . $profile->id,
                'student_id'    =>  'required|unique:indv_profiles,student_id,' . $profile->id,
                'student_class' =>  'required'
            ];
            $this->validate($request, $rules);
            $profile->update(array_only($request->all(), array_keys($rules)));
            $log->createUserLog($id, 2, 'Profile');
        } else {
            $rules = [
                'user_id'       =>  '',
                'mobile_no'     =>  'required|numeric|unique:indv_profiles',
                'student_id'    =>  'required',
                'student_class' =>  'required'
            ];
            $this->validate($request, $rules);
            $request['user_id'] = $id;
            $profile = Profile::create(array_only($request->all(), array_keys($rules)));
            $log->createUserLog($id, 1, 'Profile');
        }

        return redirect()->route('frontend.home');
    }
}
