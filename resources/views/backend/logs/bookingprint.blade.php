<!DOCTYPE html>
<html>
<head>
	<!-- Standard Meta-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-compatible" content="IE-edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0">

	<title></title>

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
		<h3><b>Booking Log</b></h3>
		<table class="table table-bordered table-condensed">
	    	<thead>
		        <tr>
		            <th>#</th>
		            <th>Name</th>
                    <th>Role</th>
                    <th>Action</th>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Booked By</th>
                    <th>Date</th>
                    <th>Time</th>
		        </tr>
		    </thead>
		    <tbody>
		    	@forelse ($logs as $index => $l)
                    <tr>
                        <td>{{ ++$index }}</td>
                        <td>{{ $l->user->firstname }}</td>
                        @if ($l->user->user_role != 1)
                        	<td>{{ $l->user->role['name'] }} Admin</td>
                        @else
                        	<td>{{ $l->user->role['name'] }}</td>
                        @endif
                        <td>{{ $l->status['name'] }}</td>
                        <td>{{ $l->booking->id }}</td>
                        <td>{{ $l->booking->sort['name'] }}</td>
                        @if ($l->user->user_role != 1)
                        	<td>{{ $l->booking->user['firstname'] }}</td>
                        @else
                        	<td></td>
                        @endif
                        <td>{{ date('d M Y', strtotime($l->created_at)) }}</td>
                        <td>{{ date('H:i:s', strtotime($l->created_at)) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td class="center aligned" colspan="8">Data Not Found</td>
                    </tr>
                @endforelse
		    </tbody>
	    </table>
</body>
</html>