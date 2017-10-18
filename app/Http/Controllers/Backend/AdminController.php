<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

use Auth;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Storage\LogRepository;
use App\User;
use App\UserRole;

class AdminController extends Controller
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

    public function index()
    {
    	$data['admin'] = User::where('user_role', '>', 1)
                            ->orderBy('firstname', 'ASC')
                            ->paginate(25);

    	return view('backend.administrators.list', $data);
    }

    public function getCreate()
    {
        $data['role'] = UserRole::where('id', '!=', 1)->orderBy('name', 'ASC')->get();
        $data['backUrl'] = Session::get('listUrl');

        return view('backend.administrators.create', $data);
    }

    public function postCreate(Request $request, LogRepository $log)
    {
        $rules = [
            'firstname' =>  'required',
            'lastname'  =>  'required',
            'email'     =>  'required|email|unique:indv_users',
            'password'  =>  'required|confirmed|min:8',
            'user_role' =>  'required'
        ];

        $this->validate($request, $rules);
        $request['password'] = bcrypt($request->get('password'));
        $user = User::create(array_only($request->all(), array_keys($rules)));
        $log->createAdminLog(Auth::id(), $user->id, 1, null);
        $url = Session::get('createUrl');

        return redirect($url);
    }

    public function getEdit($adminID)
    {
        $data['admin'] = User::findOrFail($adminID);
        $data['role'] = UserRole::where('id', '!=', 1)->orderBy('name', 'ASC')->get();
        $data['backUrl'] = Session::get('listUrl');

        return view('backend.administrators.edit', $data);
    }

    public function postEdit($adminID, Request $request, LogRepository $log)
    {
        $rules = [
            'firstname' =>  'required',
            'lastname'  =>  'required',
            'email'     =>  'required|email|unique:indv_users,email,' . $adminID,
            'user_role' =>  'required'
        ];

        $this->validate($request, $rules);
        $admin = User::findOrFail($adminID);
        $admin->update(array_only($request->all(), array_keys($rules)));
        $log->createAdminLog(Auth::id(), $adminID, 2, null);
        $url = Session::get('listUrl');

        return redirect($url);
    }

    public function delete($adminID, LogRepository $log)
    {
        $id = Auth::id();

        $admin = User::findOrFail($adminID);
        $log->createAdminLog($id, null, 3, $admin->firstname .' : '. $admin->role['name'] .' admin');

        // Delete Admin
        $admin->delete();

        // Delete Log
        $log->deleteAdmin($adminID);
        
        $url = Session::get('listUrl');

        return redirect($url);
    }
}
