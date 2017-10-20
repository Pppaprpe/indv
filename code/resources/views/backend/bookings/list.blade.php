@extends('backend.layouts.app')

@section('backend-content')

                            <i class="right chevron icon divider"></i>
                            <a class="section" href="{{ route('backend.bookings.list') }}">
                                Booking Management
                            </a>
                            <i class="arrow right icon divider"></i>
                            <div class="active section">Booking List</div>
                        </div> <!-- End Breadcrumb -->
                    </div> <!-- End Breadcrumb Column -->
                </div> <!-- End Breadcrumb Row -->
                <div class="row">
                    <div class="column">
                        <div class="ui basic compact segment">
                            <h5 class="ui header">
                                Booking List
                            </h5>
                            <form class="ui form" method="GET" action="{{ route('backend.bookings.search') }}">
                                {{ csrf_field() }}
                                <div class="inline fields">
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
                                    <button class="ui tiny orange inverted submit button" type="submit">
                                        <i class="search icon"></i>Search
                                    </button>
                                </div>
                            </form>
                            <table id="list-table" class="ui compact striped celled table">
                                <thead>
                                    <tr>
                                        <th><i class="hashtag icon"></i></th>
                                        <th>Name</th>
                                        <th>Std. Class</th>
                                        <th>Date</th>
                                        <th>Period</th>
                                        <th>Category</th>
                                        <th>Syllabus</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($booking as $index => $b)
                                        <tr>
                                            <td>{{ ++$index }}</td>
                                            <td>{{ $b->user->firstname }} {{ $b->user->lastname }}</td>
                                            <td>{{ $b->student_class }}</td>
                                            <td>
                                                {{ date('d M Y', strtotime($b->startdate)) }} - {{ date('d M Y', strtotime($b->enddate)) }}
                                            </td>
                                            <td>{{ $b->period->name }}</td>
                                            <td>{{ $b->sort->name }}</td>
                                            <td>{{ $b->course['name'] }}</td>
                                            <td>{{ $b->status['name'] }}</td>
                                            <td>
                                                @if ($b->booking_status < 2)
                                                    <a class="ui green tiny label" href="{{ route('backend.bookings.accept', $b->booking_id) }}">
                                                        <i class="checkmark icon"></i>
                                                        Accept
                                                    </a>
                                                @endif
                                                @if ($b->booking_status < 3)
                                                    <a class="ui red tiny label" href="{{ route('backend.bookings.cancel', $b->booking_id) }}" onclick="confirmDelete()">
                                                        <i class="remove icon"></i>
                                                        Cancel
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="center aligned" colspan="9">Data Not Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="10">
                                            <a class="ui left floated tiny blue button" href="{{ route('backend.bookings.print', 1) }}">
                                                <i class="print icon"></i>Print Flight
                                            </a>
                                            <a class="ui left floated tiny olive button" href="{{ route('backend.bookings.print', 2) }}">
                                                <i class="print icon"></i>Print Simulator
                                            </a>

                                            <!-- Pagination -->
                                            @if ($booking->total() > 0)
                                                <div class="ui right floated mini pagination menu">
                                                    @php ($link_limit = 7)
                                                    <a class="item {{ $booking->currentPage() == 1 ? 'disabled' : '' }}" href="{{ $booking->url(1) }}">
                                                        <i class="left chevron icon"></i>
                                                    </a>
                                                    <a class="item {{ $booking->currentPage() == $booking->lastPage() ? 'disabled' : '' }}" href="{{ $booking->previousPageUrl() }}">
                                                        Prev
                                                    </a>
                                                    @for ($i = 1; $i <= $booking->lastPage(); $i++)
                                                        <?php
                                                            $half = floor($link_limit/2);
                                                            $from = $booking->currentPage() - $half;
                                                            $to = $booking->currentPage() + $half;
                                                            if ($booking->currentPage() < $half)
                                                            {
                                                                $to += $half - $booking->currentPage();
                                                            }
                                                            if ($booking->lastPage() - $booking->currentPage() < $half)
                                                            {
                                                                $from -= $half - ($booking->lastPage() - $booking->currentPage()) - 1;
                                                            }
                                                        ?>
                                                        @if ($from < $i && $i < $to)
                                                            <a class="item {{ $booking->currentPage() == $i ? 'active' : '' }}" href="{{ $booking->url($i) }}">
                                                                {{ $i }}
                                                            </a>
                                                        @endif
                                                    @endfor
                                                    <a class="item {{ $booking->currentPage() == $booking->lastPage() ? 'disabled' : '' }}" href="{{ $booking->nextPageUrl() }}">
                                                        Next
                                                    </a>
                                                    <a class="item {{ $booking->currentPage() == $booking->lastPage() ? 'disabled' : '' }}" href="{{ $booking->url($booking->lastPage()) }}">
                                                        <i class="right chevron icon"></i>
                                                    </a>
                                                </div>
                                            @endif
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div> <!-- End Grid -->
        </div> <!-- End Container -->
    </div> <!-- End Pusher -->

{{ Session::put('listUrl', $booking->url($booking->currentPage())) }}
<script type="text/javascript">
    function confirmDelete() {
        var result = confirm('Are you sure you want to cancel?');
        if (result) {
            return true;
        } else {
            event.preventDefault();
        }
    }
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