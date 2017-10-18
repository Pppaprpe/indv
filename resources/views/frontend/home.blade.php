@extends('frontend.layouts.app')

@section('frontend-content')

                <div class="caption">
 			        <h1 class="animated fadeInLeftBig">
                        <span>Bangkok Aviation Center</span>
                    </h1>
                    <p class="animated fadeInRightBig">
                        <strong>Learn to fly Professionally</strong>
                    </p>
                    <br>
                    <div class="container" id="services">
                        <div class="text-center our-services">
                            <div class="col-xs-12 col-sm-8 col-md-6 col-md-offset-3 col-sm-offset-2">
                                <div class="row">
                                    <div class="col-xs-6 col-sm-4 col-md-4 col-md-offset-2 wow fadeInDown">
                                        <a class="service-icon" href="{{ route('frontend.flight.mybooking') }}">
                                            <strong>F</strong>
                                        </a>
                                        <div class="service-info">
                                            <h3>Flight Booking</h3>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-4 col-md-4 wow fadeInDown">
                                        <a class="service-icon" href="{{ route('frontend.simulator.mybooking') }}">
                                            <strong>S</strong>
                                        </a>
                                        <div class="service-info">
                                            <h3>Simulator Booking</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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