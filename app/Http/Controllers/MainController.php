<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Http\Requests;
use App\Repositories\Storage\LogRepository;
use App\Models\UserLog;

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

    public function checkRole(LogRepository $log)
    {
        $id = Auth::id();
        $role = Auth::user()->user_role;
        $token = Auth::user()->remember_token;
        
        if($role == 1) {
            if ($token != null) {
                $log->createUserLog($id, 5, '');
                return redirect()->route('frontend.home');
            } else {
                $userCheck = UserLog::where('user_id', '=', Auth::id())
                                    ->where('action', '=', 4)
                                    ->first();
                if($userCheck) {
                    return redirect()->route('frontend.profile.get');
                } else {
                    $log->createUserLog($id, 4, '');
                    return redirect()->route('frontend.profile.get');
                }
            }
        } else {
            return redirect()->route('backend.home');
        }
    }
}
