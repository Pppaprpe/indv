<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();

Route::get('/checkrole', 'MainController@checkRole');

Route::group(['namespace' => 'Frontend'], function() {
	Route::get('/', function() {
		if (Auth::check()) {
			if (Auth::user()->user_role == 4) {
				return redirect()->route('frontend.home');
			} else {
				return redirect()->route('backend.home');
			}
		}
		return view('frontend.welcome');
	});
	Route::group(['prefix' => 'user', 'middleware' => ['auth', 'auth.user']], function() {
		Route::get('/home', [
			'as'	=>	'frontend.home',
			'uses'	=>	'MainController@index'
		]);
		Route::get('/profile', [
			'as'	=>	'frontend.profile.get',
			'uses'	=>	'MainController@getProfile'
		]);
		Route::post('/profile', [
			'as'	=>	'frontend.profile.post',
			'uses'	=>	'MainController@postProfile'
		]);
	});
	Route::group(['prefix' => 'flight', 'middleware' => ['auth', 'auth.user']], function() {
		Route::get('/mybooking', [
			'as'	=>	'frontend.flight.mybooking',
			'uses'	=>	'FlightBookingController@index'
		]);
		Route::get('/booking', [
			'as'	=>	'frontend.flight.booking.get',
			'uses'	=>	'FlightBookingController@getBooking'
		]);
		Route::post('/booking', [
			'as'	=>	'frontend.flight.booking.post',
			'uses'	=>	'FlightBookingController@postBooking'
		]);
		Route::get('/rebooking/{booking_id}', [
			'as'	=>	'frontend.flight.rebooking.get',
			'uses'	=>	'FlightBookingController@getReBooking'
		]);
		Route::post('/rebooking/{booking_id}', [
			'as'	=>	'frontend.flight.rebooking.post',
			'uses'	=>	'FlightBookingController@postReBooking'
		]);
		Route::get('/cancel/{booking_id}', [
			'as'	=>	'frontend.flight.cancel',
			'uses'	=>	'FlightBookingController@cancelBooking'
		]);
	});
	Route::group(['prefix' => 'simulator', 'middleware' => ['auth', 'auth.user']], function() {
		Route::get('/mybooking', [
			'as'	=>	'frontend.simulator.mybooking',
			'uses'	=>	'SimulatorBookingController@index'
		]);
		Route::get('/booking', [
			'as'	=>	'frontend.simulator.booking.get',
			'uses'	=>	'SimulatorBookingController@getBooking'
		]);
		Route::post('/booking', [
			'as'	=>	'frontend.simulator.booking.post',
			'uses'	=>	'SimulatorBookingController@postBooking'
		]);
		Route::get('/rebooking/{booking_id}', [
			'as'	=>	'frontend.simulator.rebooking.get',
			'uses'	=>	'SimulatorBookingController@getRebooking'
		]);
		Route::post('/rebooking/{booking_id}', [
			'as'	=>	'frontend.simulator.rebooking.post',
			'uses'	=>	'SimulatorBookingController@postReBooking'
		]);
		Route::get('/cancel/{booking_id}', [
			'as'	=>	'frontend.simulator.cancel',
			'uses'	=>	'SimulatorBookingController@cancelBooking'
		]);
	});
});

Route::group(['namespace' => 'Backend', 'middleware' => ['auth', 'auth.admin']], function() {
	Route::get('/home', [
		'as'	=>	'backend.home',
		'uses'	=>	'MainController@index'
	]);
	Route::group(['prefix' => 'admin'], function() {
		Route::get('/list', [
			'as'	=>	'backend.admin.list',
			'uses'	=>	'AdminController@index'
		]);
		Route::get('/create', [
			'as'	=>	'backend.admin.create.get',
			'uses'	=>	'AdminController@getCreate'
		]);
		Route::post('/create', [
			'as'	=>	'backend.admin.create.post',
			'uses'	=>	'AdminController@postCreate'
		]);
		Route::get('/edit/{admin_id}', [
			'as'	=>	'backend.admin.edit.get',
			'uses'	=>	'AdminController@getEdit'
		]);
		Route::post('/edit/{admin_id}', [
			'as'	=>	'backend.admin.edit.post',
			'uses'	=>	'AdminController@postEdit'
		]);
		Route::delete('/delete/{admin_id}', [
			'as'	=>	'backend.admin.delete',
			'uses'	=>	'AdminController@delete'
		]);
	});
	Route::group(['prefix' => 'bookings'], function() {
		Route::get('/list', [
			'as'	=>	'backend.bookings.list',
			'uses'	=>	'BookingController@index'
		]);
		Route::get('/edit/{booking_id}', [
			'as'	=>	'backend.bookings.edit.get',
			'uses'	=>	'BookingController@getEdit'
		]);
		Route::post('/edit/{booking_id}', [
			'as'	=>	'backend.bookings.edit.post',
			'uses'	=>	'BookingController@postEdit'
		]);
		Route::get('/accept/{booking_id}', [
			'as'	=>	'backend.bookings.accept',
			'uses'	=>	'BookingController@acceptBooking'
		]);
		Route::get('/cancel/{booking_id}', [
			'as'	=>	'backend.bookings.cancel',
			'uses'	=>	'BookingController@cancelBooking'
		]);
		Route::get('/print/{sort_id}', [
			'as'	=>	'backend.bookings.print',
			'uses'	=>	'PDFPrintController@bookingPrint'
		]);
		Route::get('/search', [
			'as'	=>	'backend.bookings.search',
			'uses'	=>	'SearchController@bookingSearch'
		]);
	});
	Route::group(['prefix' => 'reports'], function() {
		Route::get('/select', [
			'as'	=>	'backend.reports.select',
			'uses'	=>	'ReportController@index'
		]);
		Route::get('/booking', [
			'as'	=>	'backend.reports.list',
			'uses'	=>	'ReportController@bookingReport'
		]);
		Route::get('/search', [
			'as'	=>	'backend.reports.search',
			'uses'	=>	'SearchController@bookingReportSearch'
		]);
		Route::get('/print', [
			'as'	=>	'backend.reports.print',
			'uses'	=>	'PDFPrintController@bookingReportPrint'
		]);
	});
	Route::group(['prefix' => 'users'], function() {
		Route::get('/list', [
			'as'	=>	'backend.users.list',
			'uses'	=>	'UserController@index'
		]);
		Route::get('/create', [
			'as'	=>	'backend.users.create.get',
			'uses'	=>	'UserController@getCreate'
		]);
		Route::post('/create', [
			'as'	=>	'backend.users.create.post',
			'uses'	=>	'UserController@postCreate'
		]);
		Route::get('/edit/{student_class_id}', [
			'as'	=>	'backend.users.edit.get',
			'uses'	=>	'UserController@getEdit'
		]);
		Route::post('/edit/{user_id}', [
			'as'	=>	'backend.users.edit.post',
			'uses'	=>	'UserController@postEdit'
		]);
		Route::get('/changestatus/{user_id}/{user_status_id}', [
			'as'	=>	'backend.users.changestatus',
			'uses'	=>	'UserController@changeStatus'
		]);
		Route::delete('/delete/{user_id}', [
			'as'	=>	'backend.users.delete',
			'uses'	=>	'UserController@delete'
		]);
	});
	Route::group(['prefix' => 'studentclass'], function() {
		Route::get('/list', [
			'as'	=>	'backend.studentclass.list',
			'uses'	=>	'StudentClassController@index'
		]);
		Route::get('/create', [
			'as'	=>	'backend.studentclass.create.get',
			'uses'	=>	'StudentClassController@getCreate'
		]);
		Route::post('/create', [
			'as'	=>	'backend.studentclass.create.post',
			'uses'	=>	'StudentClassController@postCreate'
		]);
		Route::get('/edit/{student_class_id}', [
			'as'	=>	'backend.studentclass.edit.get',
			'uses'	=>	'StudentClassController@getEdit'
		]);
		Route::post('/edit/{student_class_id}', [
			'as'	=>	'backend.studentclass.edit.post',
			'uses'	=>	'StudentClassController@postEdit'
		]);
		Route::delete('/delete/{student_class_id}', [
			'as'	=>	'backend.studentclass.delete',
			'uses'	=>	'StudentClassController@delete'
		]);
	});
	Route::group(['prefix' => 'logs'], function() {
		Route::get('/booking', [
			'as'	=>	'backend.logs.booking',
			'uses'	=>	'LogController@bookingLog'
		]);
		Route::get('/user', [
			'as'	=>	'backend.logs.user',
			'uses'	=>	'LogController@userLog'
		]);
		Route::get('/admin', [
			'as'	=>	'backend.logs.admin',
			'uses'	=>	'LogController@adminLog'
		]);
		Route::get('/printlog/{log_id}', [
			'as'	=>	'backend.logs.print',
			'uses'	=>	'PDFPrintController@logPrint'
		]);
	});
	Route::group(['prefix' => 'settings'], function() {
		Route::get('/changepassword', [
			'as'	=>	'backend.settings.changepassword.get',
			'uses'	=>	'SettingController@getChangePassword'
		]);
		Route::post('/changepassword', [
			'as'	=>	'backend.settings.changepassword.post',
			'uses'	=>	'SettingController@postChangePassword'
		]);
	});
});


