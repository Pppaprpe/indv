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
                Booking List
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
                    @if ($check == 1)
                        <th>Syllabus</th>
                    @endif
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $index => $b)
                    <tr>
                        <td>{{ ++$index }}</td>
                        <td>{{ $b->user->firstname }} {{ $b->user->lastname }}</td>
                        <td>{{ $b->student_class }}</td>
                        <td>{{ date('d M Y', strtotime($b->startdate)) }} - {{ date('d M Y', strtotime($b->enddate)) }}</td>
                        <td>{{ $b->period->name }}</td>
                        <td>{{ $b->sort->name }}</td>
                        @if ($check == 1)
                            <td>{{ $b->course['name'] }}</td>
                        @endif
                        <td>{{ $b->status->name }}</td>
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