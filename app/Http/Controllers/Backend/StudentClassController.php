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
use App\Models\Profile;
use App\Models\StudentClass;

class StudentClassController extends Controller
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
        $data['stdclass'] = StudentClass::orderBy('name', 'ASC')->paginate(25);
        $data['stdcount'] = Profile::select(DB::raw('student_class, count(*) as count'))
                                    ->groupBy('student_class')
                                    ->get();

    	return view('backend.studentclass.list', $data);
    }

    public function getCreate()
    {
    	$data['backUrl'] = Session::get('listUrl');

        return view('backend.studentclass.create', $data);
    }

    public function postCreate(Request $request, LogRepository $log)
    {
    	$rules = ['name'   =>  'required'];
        $this->validate($request, $rules);
        $stdclass = StudentClass::create(array_only($request->all(), array_keys($rules)));
        $log->createAdminLog(Auth::id(), null, 1, 'student class: ' . $stdclass->name);
        $url = Session::get('createUrl');

        return redirect($url);
    }

    public function getEdit($stdclassID)
    {
        $data['stdclass'] = StudentClass::findOrFail($stdclassID);
    	$data['backUrl'] = Session::get('listUrl');

        return view('backend.studentclass.edit', $data);
    }

    public function postEdit($stdclassID, Request $request, LogRepository $log)
    {
    	$rules = ['name'   =>  'required'];
        $this->validate($request, $rules);
        $stdclass = StudentClass::findOrFail($stdclassID);
        $oldname = $stdclass->name;
        $stdclass->update(array_only($request->all(), array_keys($rules)));
        $log->createAdminLog(Auth::id(), null, 2, 'student class: '. $oldname .' to '. $stdclass->name);
        $url = Session::get('listUrl');

        return redirect($url);
    }

    public function delete($stdclassID, LogRepository $log)
    {
    	$stdclass = StudentClass::findOrFail($stdclassID);
        $oldname = $stdclass->name;
        $stdclass->delete();
        $log->createAdminLog(Auth::id(), null, 3, 'student class: ' . $oldname);
        $url = Session::get('listUrl');

        return redirect($url);
    }
}
