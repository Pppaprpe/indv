@extends('frontend.layouts.app')

@section('frontend-content')

                <div id="mybook" class="caption-mybook">
 			        <h2 class="animated fadeInLeftBig">Flight Booking</h2>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 animated fadeInRightBig">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Start Date</th>
                                    <th>End date</th>
                                    <th>Period</th>
                                    <th>Syllabus</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($booking as $index => $b)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ date('d M Y', strtotime($b->startdate)) }}</td>
                                        <td>{{ date('d M Y', strtotime($b->enddate)) }}</td>
                                        <td>{{ $b->period['name'] }}</td>
                                        <td>{{ $b->course['name'] }}</td>
                                        @if ($b->booking_status == 1)
                                            <td>Waiting for Scheduling your Flight</td>
                                            <td>
                                                <a class="btn btn-danger btn-sm" href="{{ route('frontend.flight.cancel', $b->id) }}" onclick="confirmCancel()">
                                                    Cancel Booking
                                                </a>
                                            </td>
                                        @elseif ($b->booking_status == 2)
                                            <td>Your Booking was Accepted</td>
                                            <td>
                                                <a class="btn btn-danger btn-sm" href="{{ route('frontend.flight.cancel', $b->id) }}" onclick="confirmCancel()">
                                                    Cancel Booking
                                                </a>
                                            </td>
                                        @elseif ($b->booking_status == 3)
                                            <td>Your Booking was Canceled</td>
                                            <td></td>
                                        @elseif ($b->booking_status == 4)
                                            <td>Your Booking was Closed</td>
                                            <td></td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">You're not booking yet</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="row">
                            @if (count($current) != 0)
                                @if ($current->booking_status > 1)
                                    <a class="btn btn-primary" href="{{ route('frontend.flight.booking.get') }}">
                                        Booking your Flight
                                    </a>
                                    @if ($current->booking_status == 2)
                                        <h4>Your booking is not confirmed yet, please check the schedule.</h4>
                                    @endif
                                @endif
                            @else
                                <a class="btn btn-primary" href="{{ route('frontend.flight.booking.get') }}">
                                    Booking your Flight
                                </a>
                            @endif
                        </div>
                    </div>

                </div><!-- End of Caption -->
                
            </div>
        </div>
    </header>

<script type="text/javascript">
    function confirmCancel() {
        var result = confirm('Are you sure you want to cancel?');
        if (result) {
            return true;
        } else {
            event.preventDefault();
        }
    }
</script>
@endsection