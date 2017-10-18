<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Standard mata -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-compatible" content="IE-edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0">

    <!-- Site Properties -->
    <title>Individual Flight Booking Management | Bangkok Aviation Center</title>
    <link rel="icon" href="{{ url('assets/images/logo.svg') }}"></head>

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/be.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/semantic.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/calendar.min.css') }}">

    <!-- Javascript -->
    
    <script src="{{ url('assets/js/jquery.min.js') }}"></script>
    <script src="{{ url('assets/js/semantic.min.js') }}"></script>
    <script src="{{ url('assets/js/calendar.min.js') }}"></script>
    <script src="{{ url('assets/js/be-form.js') }}"></script>
</head>
<body id="app-layout">

    <!-- Sidebar Menu -->
    <div class="ui left fixed orange vertical sidebar menu visible">
        <div class="item">
            <img class="ui centered image" src="{{ url('assets/images/logo.svg') }}">
            <h5 class="ui orange centered header">
                INDIVIDUAL FLIGHT BOOKING MANAGEMENT
            </h5>
            <div class="ui hidden divider"></div>
        </div>
        <a class="item {{ Route::getCurrentRoute()->getPath() == 'home' ? 'active' : '' }}" href="{{ route('backend.home') }}">
            <i class="home icon"></i>
            Home
        </a>
        @if (Auth::user()->user_role == 2 || Auth::user()->user_role == 3)
            <div class="item {{ Route::getCurrentRoute()->getPrefix() == '/bookings' ? 'active' : '' }}">
                <div class="header">
                    <i class="plane icon"></i>
                    Bookings
                </div>
                <div class="menu">
                    <a class="item {{ Route::getCurrentRoute()->getPath() == 'bookings/list' ? 'active' : '' }}" href="{{ route('backend.bookings.list') }}">
                        <i class="list icon"></i>
                        Booking List
                    </a>
                    <a class="item {{ Route::getCurrentRoute()->getPrefix() == '/reports' ? 'active' : '' }}" href="{{ route('backend.reports.select') }}">
                        <i class="book icon"></i>
                        Booking Report
                    </a>
                </div>
            </div>
        @endif
        <a class="item {{ Route::getCurrentRoute()->getPrefix() == '/users' ? 'active' : '' }}" href="{{ route('backend.users.list') }}">
            <i class="user icon"></i>
            Students
        </a>
        <a class="item {{ Route::getCurrentRoute()->getPrefix() == '/studentclass' ? 'active' : '' }}" href="{{ route('backend.studentclass.list') }}">
            <i class="student icon"></i>
            Std. Classes
        </a>
        @if (Auth::user()->user_role == 2)
            <a class="item {{ Route::getCurrentRoute()->getPrefix() == '/admin' ? 'active' : '' }}" href="{{ route('backend.admin.list') }}">
                <i class="privacy icon"></i>
                Admins
            </a>
            <div class="item {{ Route::getCurrentRoute()->getPrefix() == '/logs' ? 'active' : '' }}">
                <div class="header">
                    <i class="file text icon"></i>
                    Logs
                </div>
                <div class="menu">
                    <a class="item {{ Route::getCurrentRoute()->getPath() == 'logs/booking' ? 'active' : '' }}" href="{{ route('backend.logs.booking') }}">
                        <i class="plane icon"></i>
                        Booking Logs
                    </a>
                    <a class="item {{ Route::getCurrentRoute()->getPath() == 'logs/user' ? 'active' : '' }}" href="{{ route('backend.logs.user') }}">
                        <i class="user icon"></i>
                        Student Logs
                    </a>
                    <a class="item {{ Route::getCurrentRoute()->getPath() == 'logs/admin' ? 'active' : '' }}" href="{{ route('backend.logs.admin') }}">
                        <i class="privacy icon"></i>
                        Admin Logs
                    </a>
                </div>
            </div>
        @endif
        <div class="item {{ Route::getCurrentRoute()->getPrefix() == '/settings' ? 'active' : '' }}">
            <div class="header">
                <i class="setting icon"></i>
                Settings
            </div>
            <div class="menu">
                <a class="item {{ Route::getCurrentRoute()->getPath() == 'settings/changepassword' ? 'active' : '' }}" href="{{ route('backend.settings.changepassword.get') }}">
                    <i class="lock icon"></i>
                    Change Password
                </a>
            </div>
        </div>
    </div>
    <!-- Top Menu -->
    <div class="ui top fixed stackable menu">
        <a class="item" id="toggle">
            <i class="sidebar icon"></i>
        </a>
        <div class="item">
            <h5 class="ui header">
                Hi, {{ Auth::user()->firstname }}
                <div class="ui teal tiny label">
                    {{ Auth::user()->role->name }} Admin
                </div>
                <a class="ui inverted orange mini button" href="{{ url('/logout') }}">
                    Logout
                </a>
            </h5>
        </div>
    </div>

    <div class="pusher">
        <div id="container" class="ui bottom fixed grey container">
            <div class="ui main grid">
                <div class="ui dimmer">
                    <div class="ui text loader">Loading</div>
                </div>
                <!-- Breadcrumb -->
                <div class="row">
                    <div class="column">
                        <div class="ui small breadcrumb">
                            <a class="section {{ Route::getCurrentRoute()->getPath() == 'admin/home' ? 'active' : '' }}" href="{{ route('backend.home') }}">Home</a> 
          
        @yield('backend-content')

        <script src="{{ url('assets/js/be.js') }}"></script>
    
</body>
</html>