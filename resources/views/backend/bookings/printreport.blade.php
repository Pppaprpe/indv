<!DOCTYPE html>
<html>
<head>
	<!-- Standard Meta-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-compatible" content="IE-edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0">

	<link rel="stylesheet" type="text/css" href="{{ url('assets/css/bootstrap.min.css') }}">
	<style>
        @font-face {
            font-family: 'THSarabunPSK';
            font-style: normal;
            font-weight: normal;
            src: url("{{ url('assets/fonts/THSarabun.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunPSK';
            font-style: normal;
            font-weight: bold;
            src: url("{{ asset('assets/fonts/THSarabun Bold.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunPSK';
            font-style: italic;
            font-weight: normal;
            src: url("{{ asset('assets/fonts/THSarabun Italic.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunPSK';
            font-style: italic;
            font-weight: bold;
            src: url("{{ asset('assets/fonts/THSarabun BoldItalic.ttf') }}") format('truetype');
        }
 
        body {
            font-family: "THSarabunPSK" !important;
            font-size: 12pt;
        }
        table > thead > tr > th {
        	font-size: 14pt;
        }

        @page {
        	margin: 2em;
        }
    </style>
</head>
<body>
		<h3>
			<b>
				Booking Report
				@if ($option == 0)
                    : All
                @elseif ($option == 1)
                    : User Booked
                @elseif ($option == 2)
                    : Accepted Booking
                @elseif ($option == 3)
                    : Canceled Booking
                @elseif ($option == 4)
                    : Closed Booking
                @endif
			</b>
		</h3>
		<table class="table table-bordered table-condensed">
	    	<thead>
		        <tr>
		            <th>#</th>
		            <th>Name</th>
                    <th>Std. Class</th>
                    <th>Date</th>
                    <th>Period</th>
                    <th>Category</th>
                    @if ($sort < 2)
                        <th>Syllabus</th>
                    @endif
                    <th>Status</th>
                    <th>Commited By</th>
		        </tr>
		    </thead>
		    <tbody>
		    	@forelse ($bookings as $index => $b)
                    <tr>
                        <td>{{ ++$index }}</td>
                        <td>{{ $b->user->firstname }} {{ $b->user->lastname }}</td>
                        <td>{{ $b->student_class }}</td>
                        <td>{{ date('d M Y', strtotime($b->booking->startdate)) }} - {{ date('d M Y', strtotime($b->booking->enddate)) }}</td>
                        <td>{{ $b->booking->period['name'] }}</td>
                        <td>{{ $b->booking->sort['name'] }}</td>
                        @if ($sort < 2)
                            <td>{{ $b->booking->course['name'] }}</td>
                        @endif
                        
                        <td>{{ $b->booking->status['name'] }}</td>
                        <td>{{ $b->user->firstname }}</td>
                    </tr>
                @empty
                    <tr>
                        @if ($sort == 0)
                            <td class="center aligned" colspan="9">Data Not Found</td>
                        @else
                            <td class="center aligned" colspan="8">Data Not Found</td>
                        @endif
                    </tr>
                @endforelse
		    </tbody>
	    </table>
</body>
</html>