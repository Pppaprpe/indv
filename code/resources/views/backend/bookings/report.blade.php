@extends('backend.layouts.app')

@section('backend-content')

                            <i class="right chevron icon divider"></i>
                            <a class="section" href="{{ route('backend.bookings.list') }}">
                                Booking Management
                            </a>
                            <i class="arrow right icon divider"></i>
                            <div class="active section">Booking Report</div>
                        </div> <!-- End Breadcrumb -->
                    </div> <!-- End Breadcrumb Column -->
                </div> <!-- End Breadcrumb Row -->
                <div class="row">
                    <div class="column">
                        <div class="ui basic compact segment">
                            <h5 class="ui header">
                                Booking Report 
                                @if ($_GET['option'] == 0)
                                    : All
                                @elseif ($_GET['option'] == 1)
                                    : User Booked
                                @elseif ($_GET['option'] == 2)
                                    : Accepted Booking
                                @elseif ($_GET['option'] == 3)
                                    : Canceled Booking
                                @elseif ($_GET['option'] == 4)
                                    : Closed Booking
                                @endif
                            </h5>
                            <table id="list-table" class="ui compact striped celled table">
                                <thead>
                                    <tr>
                                        <th><i class="hashtag icon"></i></th>
                                        <th>Name</th>
                                        <th>Std. Class</th>
                                        <th>Date</th>
                                        <th>Period</th>
                                        <th>Category</th>
                                        @if ($_GET['sort'] < 2)
                                            <th>Syllabus</th>
                                        @endif
                                        <th>Status</th>
                                        <th>Commited By</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($booking as $index => $b)
                                        <tr>
                                            <td>{{ ++$index }}</td>
                                            <td>{{ $b->user->firstname }} {{ $b->user->lastname }}</td>
                                            <td>{{ $b->student_class }}</td>
                                            <td>{{ date('d M Y', strtotime($b->booking->startdate)) }} - {{ date('d M Y', strtotime($b->booking->enddate)) }}</td>
                                            <td>{{ $b->booking->period['name'] }}</td>
                                            <td>{{ $b->booking->sort['name'] }}</td>
                                            @if ($_GET['sort'] < 2)
                                                <td>{{ $b->booking->course['name'] }}</td>
                                            @endif
                                            
                                            <td>{{ $b->booking->status['name'] }}</td>
                                            <td>{{ $b->user->firstname }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            @if ($_GET['sort'] == 0)
                                                <td class="center aligned" colspan="9">Data Not Found</td>
                                            @else
                                                <td class="center aligned" colspan="8">Data Not Found</td>
                                            @endif
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="9">
                                            <form class="ui form" method="GET" action="{{ route('backend.reports.print') }}">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="option" value="{{ $_GET['option'] }}">
                                                <input type="hidden" name="sort" value="{{ $_GET['sort'] }}">
                                                <input type="hidden" name="startdate" value="{{ $_GET['startdate'] }}">
                                                <input type="hidden" name="enddate" value="{{ $_GET['enddate'] }}">
                                                <a class="ui left floated tiny button" href="{{ url()->previous() }}">
                                                    <i class="left arrow icon"></i>Back
                                                </a>
                                                <button class="ui left floated tiny blue button" type="submit">
                                                    <i class="print icon"></i>Print
                                                </button>
                                            </form>
                                            

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