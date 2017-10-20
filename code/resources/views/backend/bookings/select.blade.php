@extends('backend.layouts.app')

@section('backend-content')

                            <i class="right chevron icon divider"></i>
                            <a class="section" href="{{ route('backend.bookings.list') }}">
                                Booking Management
                            </a>
                            <i class="arrow right icon divider"></i>
                            <div class="active section">Report Option</div>
                        </div> <!-- End Breadcrumb -->
                    </div> <!-- End Breadcrumb Column -->
                </div> <!-- End Breadcrumb Row -->
                <div class="row">
                    <div class="column">
                        <div class="ui basic compact segment">
                            <h5 class="ui header">
                                Report Option
                            </h5>
                            <form class="ui form" method="GET" action="{{ route('backend.reports.search') }}">
                                {{ csrf_field() }}
                                <div class="field">
                                    <select class="ui selection dropdown" name="option">
                                        <option class="default text">Choose your Report Option</option>
                                        <option value="0">All</option>
                                        <option value="1">User Booked</option>\
                                        <option value="2">Accepted Booking</option>
                                        <option value="3">Canceled Booking</option>
                                        <option value="4">Closed Booking</option>
                                    </select>
                                </div>
                                <div class="field">
                                    <select class="ui selection dropdown" name="sort">
                                        <option class="default text">Choose Booking Category</option>
                                        <option value="0">All</option>
                                        <option value="1">Flight</option>
                                        <option value="2">Simulator</option>
                                    </select>
                                </div>
                                <div class="field">
                                    <div class="ui calendar" id="startdate">
                                        <div class="ui left icon input">
                                            <i class="calendar icon"></i>
                                            @if (isset($_GET['startdate']))
                                                <input type="text" name="startdate" placeholder="Start Date" value="{{ $_GET['startdate'] }}">
                                            @else
                                                <input type="text" name="startdate" placeholder="Start Date" value="{{ old('startdate') }}">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="ui calendar" id="enddate">
                                        <div class="ui left icon input">
                                            <i class="calendar icon"></i>
                                            @if (isset($_GET['enddate']))
                                                <input type="text" name="enddate" placeholder="End Date" value="{{ $_GET['enddate'] }}">
                                            @else
                                                <input type="text" name="enddate" placeholder="End Date" value="{{ old('enddate') }}">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <button class="ui tiny fluid orange inverted submit button" type="submit">
                                    <i class="search icon"></i>Search
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div> <!-- End Grid -->
        </div> <!-- End Container -->
    </div> <!-- End Pusher -->

<script type="text/javascript">
    $('#startdate').calendar({
        type: 'date',
        endCalendar: $('#enddate')
    });
    $('#enddate').calendar({
        type: 'date',
        startCalendar: $('#startdate')
    });
</script>

@endsection