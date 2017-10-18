@extends('frontend.layouts.app')

@section('frontend-content')

                <div class="caption-form">
                    <h2 class="animated fadeInLeftBig">Re-Booking your Flight</h2>
                    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                        <form class="form animated fadeInRightBig" method="POST" action="{{ route('frontend.flight.rebooking.post') }}">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <label for="booking_sort">Booking Category</label>
                                        <input class="form-control text-center" type="text" name="booking_sort" value="Flight" readonly="">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4">
                                    <div class="form-group {{ $errors->has('booking_period') ? 'has-error' : '' }}">
                                        <label for="booking_period">Booking Period</label>
                                        <select class="form-control" id="booking_period" name="booking_period">
                                                <option value="">Choose your Period</option>
                                            @foreach ($period as $p)
                                                <option value="{{ $p->id }}" {{ ( $booking->booking_period == $p->id ? 'selected' : '' ) }}>{{ $p->name }}</option>
                                            @endforeach
                                            @if ($errors->has('booking_period'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('booking_period') }}</strong>
                                                </span>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4">
                                    <div class="form-group {{ $errors->has('syllabus') ? 'has-error' : '' }}">
                                        <label for="syllabus">Syllabus</label>
                                        <select class="form-control" id="syllabus" name="syllabus">
                                                <option value="">Choose your Syllabus</option>
                                            @foreach ($course as $a)
                                                <option value="{{ $a->id }}" {{ ( $booking->syllabus == $a->id ? 'selected' : '' ) }}>{{ $a->name }}</option>
                                            @endforeach
                                            @if ($errors->has('syllabus'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('syllabus') }}</strong>
                                                </span>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group {{ $errors->has('startdate') ? 'has-error' : '' }}">
                                        <label for="startdate">Booking Date</label>
                                        <input class="form-control text-center" type="text" name="startdate" id="startdate" placeholder="Choose your Date" value="{{ $booking->startdate }}">
                                        @if ($errors->has('startdate'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('startdate') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group {{ $errors->has('enddate') ? 'has-error' : '' }}">
                                        <label for="form-group">Booking End Date</label>
                                        <input class="form-control text-center" type="text" name="enddate" id="enddate" placeholder="Choose your End Date" value="{{ $booking->enddate }}">
                                        @if ($errors->has('enddate'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('enddate') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-group-lg">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-lg animated fadeInUpBig">
                                        Confirm
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- End of Caption -->
            </div>
        </div>
    </header>

    <script type="text/javascript">
        var checkin = $('#startdate').datepicker({
            onRender: function(date) {
                return date.valueOf() <= moment().valueOf() ? 'disabled' : '';
            },
            format: 'yyyy/mm/dd'
        }).on('changeDate', function(ev) {
            if (ev.date.valueOf() > checkout.date.valueOf()) {
                var newDate = new Date(ev.date);
                newDate.setDate(newDate.getDate());
                checkout.setValue(newDate);
            }
            checkin.hide();
            $('#enddate')[0].focus();
        }).data('datepicker');
        var checkout = $('#enddate').datepicker({
            onRender: function(date) {
                return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
            },
            format: 'yyyy/mm/dd'
        }).on('changeDate', function(ev) {
            checkout.hide();
        }).data('datepicker');
    </script>
@endsection