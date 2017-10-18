<!DOCTYPE html>
<html>
<head>
    <!-- Standard meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Site properties -->
    <title>Individual Flight Booking | Bangkok Aviation Center</title>
    <link rel="icon" href="{{ url('assets/images/logo.svg') }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/datepicker.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/main.css') }}">
    <link rel="stylesheet" id="css-preset" href="{{ url('assets/css/presets/preset2.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/responsive.css') }}">

    
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>

    <script type="text/javascript" src="{{ url('assets/js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/js/jquery.inview.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/js/wow.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/js/mousescroll.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/js/smoothscroll.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/js/jquery.countTo.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/js/bootstrap-datepicker.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/js/main.js') }}"></script>
    
</head>
<body>
    <div class="preloader"> <i class="fa fa-circle-o-notch fa-spin"></i></div>

    <header id="home">
        <div class="main-nav">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <h1><img class="img-responsive" src="{{ url('assets/images/logo.svg') }}" alt="logo"></h1>
                    </a>                    
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        @if (Auth::check())
                            <li class="scroll {{ Route::getCurrentRoute()->getPath() == 'user/home' ? 'active' : '' }}">
                                <a href="{{ route('frontend.home') }}">Home</a>
                            </li>
                            <li class="scroll {{ Route::getCurrentRoute()->getPath() == 'user/profile' ? 'active' : '' }}">
                                <a href="{{ route('frontend.profile.get') }}">Profile</a>
                            </li>
                            <li class="scroll {{ Route::getCurrentRoute()->getPrefix() == '/flight' ? 'active' : '' }}">
                                <a href="{{ route('frontend.flight.mybooking') }}">Flight</a>
                            </li> 
                            <li class="scroll {{ Route::getCurrentRoute()->getPrefix() == '/simulator' ? 'active' : '' }}">
                                <a href="{{ route('frontend.simulator.mybooking') }}">Simulator</a>
                            </li> 
                            <li class="scroll {{ Route::getCurrentRoute()->getPath() == 'logout' ? 'active' : '' }}">
                                <a href="{{ url('/logout') }}">Logout</a>
                            </li>
                        @else
                            <li class="scroll {{ Route::getCurrentRoute()->getPath() == '/' ? 'active' : '' }}">
                                <a href="{{ url('/') }}">Home</a>
                            </li> 
                            <li class="scroll {{ Route::getCurrentRoute()->getPath() == 'register' ? 'active' : '' }}">
                                <a href="{{ url('/register') }}">Register</a>
                            </li>
                            <li class="scroll {{ Route::getCurrentRoute()->getPath() == 'login' ? 'active' : '' }}">
                                <a href="{{ url('/login') }}">Login</a>
                            </li>
                        @endif 
                    </ul>
                </div>
            </div>
        </div>
        <div id="home-slider">
            <div class="item active">                

                    @yield('frontend-content')       
    
</body>
</html>