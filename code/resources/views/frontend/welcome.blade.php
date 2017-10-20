@extends('frontend.layouts.app')

@section('frontend-content')

                <div class="caption">
 			        <h1 class="animated fadeInLeftBig">Welcome to <br>
                        <span>Individual Flight Booking</span>
                    </h1>
                    <p class="animated fadeInRightBig">
                        <strong>Please <a href="{{ url('/login') }}" data-toggle="tooltip" title="Click to Login">Login</a> for Booking your Flight or <a href="{{ url('/register') }}" data-toggle="tooltip" title="Click to Register">Register</a> for your First Time.</strong>
                    </p>
                </div><!-- End of Caption -->
            </div>
        </div>
    </header>
<script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
    });
</script>
@endsection