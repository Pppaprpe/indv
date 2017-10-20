<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use Hash;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Repositories\Storage\LogRepository;

class SettingController extends Controller
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

    public function getChangePassword()
    {
    	return view('backend.settings.changepassword');
    }

    public function postChangePassword(Request $request, LogRepository $log)
    {
    	$id = Auth::id();

        $user = User::findOrFail($id);
        $this->validate($request, ['password' => 'required|confirmed']);

        $oldpassword = $request->get('old_password');
        $request['password'] = bcrypt($request->get('password'));

        if (Hash::check($oldpassword, $user->password)) {
            $user->update($request->all());
            $log->createAdminLog($id, null, 2, 'changed password');
            
            return redirect('/logout');
        } else {
            return redirect()->route('backend.settings.changepassword.get');
        }
    }
}
