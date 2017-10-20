@extends('backend.layouts.app')

@section('backend-content')

                            <i class="right chevron icon divider"></i>
                            <a class="section" href="{{ route('backend.bookings.list') }}">
                                Booking Management
                            </a>
                            <i class="arrow right icon divider"></i>
                            <div class="active section">Edit Booking</div>
                        </div> <!-- End Breadcrumb -->
                    </div> <!-- End Breadcrumb Column -->
                </div> <!-- End Breadcrumb Row -->
                <div class="row">
                    <div class="column">
                        <div class="ui basic compact segment" id="user-form">
                            <div class="ui top attached menu">
                                <div class="item">
                                    <h4 class="ui orange header">Edit Booking</h4>
                                </div>
                            </div>
                            <div class="ui bottom attached segment">
                                <form class="ui form" method="POST" action="{{ route('backend.bookings.edit.post', $booking->id) }}">
                                    {{ csrf_field() }}
                                    <div class="two fields">
                                        <div class="field">
                                        	<label for="firstname">Firstname</label>
                                            <input type="text" name="firstname" value="{{ $user->firstname }}" readonly="">
                                        </div>
                                        <div class="field">
                                        	<label for="lastname">Lastname</label>
                                            <input type="text" name="lastname" value="{{ $user->lastname }}" readonly="">
                                        </div>
                                    </div>
                                    <div class="three fields">
                                        <div class="field">
                                        	<label for="student_id">Student ID</label>
                                            <input type="text" name="student_id" value="{{ $user->student_id }}" readonly="">
                                        </div>
                                        <div class="field">
                                        	<label for="student_class">Student Class</label>
                                            <input type="text" name="student_class" value="{{ $user->student_class }}" readonly="">
                                        </div>
                                         <div class="field">
                                        	<label for="mobile_no">Mobile Number</label>
                                            <input type="text" name="mobile_no" value="{{ $user->mobile_no }}" readonly="">
                                        </div>
                                    </div>
                                    <div class="ui divider"></div>
                                    <div class="two fields">
                                        <div class="field">
                                        	<label for="booking_sort">Booking Category</label>
                                            <input type="text" name="booking_sort" value="{{ $booking->sort['name'] }}" readonly="">
                                        </div>
                                        <div class="field">
                                        	<label for="booking_period">Booking Period</label>
                                            <input type="text" name="booking_period" value="{{ $booking->period['name'] }}" readonly="">
                                        </div>
                                    </div>
                                    @if ($booking->booking_sort == 1)
	                                    <div class="two fields">
	                                        <div class="field">
	                                        	<label for="aircraft">Aircraft</label>
                                                <input type="text" name="aircraft" value="{{ $booking->plane['name'] }}" readonly="">
	                                        </div>
	                                        <div class="field">
	                                        	<label for="startdate">Booking Date</label>
                                        		<input type="text" name="startdate" value="{{ date('d M Y', strtotime($booking->startdate)) }}" readonly="">
	                                        </div>
	                                    </div>
	                                @else
	                                	<div class="three fields">
	                                        <div class="field">
	                                        	<label for="startdate">Booking Start Date</label>
	                                            <input type="text" name="startdate" value="{{ date('d M Y', strtotime($booking->startdate)) }}" readonly="">
	                                        </div>
	                                        <div class="field">
	                                        	<label for="enddate">Booking End Date</label>
	                                        	<input type="text" name="enddate" value="{{ date('d M Y', strtotime($booking->enddate)) }}" readonly="">
	                                        </div>
	                                        <div class="field">
	                                        	<label for="booking_sort">Booking Confirm Date</label>
	                                        	<div class="ui calendar" id="calendar">
	                                        		<div class="ui left icon input">
	                                        			<i class="calendar icon"></i>
	                                        			<input type="text" name="confirmdate" placeholder="{{ date('d M Y') }}" id="confirmdate">
	                                        		</div>
	                                        	</div>
	                                        </div>
	                                    </div>
	                                @endif
	                                <div class="ui hidden divider"></div>
	                                <div class="three fields">
	                                	<div class="three wide field"></div>
		                                <div class="ten wide field">
		                                	<label for="booking_status">
		                                		<h4 class="ui orange centered header">Choose the Action for this Booking</h4>
		                                	</label>
		                                	<div id="select-status">
		                                		<select class="ui selection dropdown" name="booking_status">
			                                		<option class="default text" value="{{ $booking->booking_status }}">
			                                			Booking Action
			                                		</option>
			                                		@foreach ($status as $s)
			                                			<option value="{{ $s->id }}">{{ $s->name }} this Booking</option>
			                                		@endforeach
			                                	</select>
		                                	</div>
		                                	
		                                </div>
		                                <div class="three wide field"></div>
	                                </div>
	                                <div class="ui hidden divider"></div>
                                    <a class="ui grey small button" href="{{ $backUrl }}">
                                        <i class="left arrow icon"></i>
                                        Back
                                    </a>
                                	<button class="ui small orange right floated submit button" type="submit">
                                        <i class="check mark icon"></i>
                                        Submit
                                    </button>
                                </form>
                            </div>                        
                        </div>
                    </div>
                </div>
            </div> <!-- End Grid -->
        </div> <!-- End Container -->
    </div> <!-- End Pusher -->

<script>

	$(document).ready(function() {

		$date = <?php echo $bookingJSON ?>;
		$('#confirmdate').prop('disabled', true);

		$('#select-status').on('change', function(e) {

			var status = e.target.value;

			if (status == '3') {

				$('#confirmdate').prop('disabled', false);
			} else {

				$('#confirmdate').prop('disabled', true);
			}
		});

		$('#calendar').calendar({
	        type: 'date',
	        monthFirst: false,
	        minDate: new Date($date.startdate),
	        maxDate: new Date($date.enddate),
	        formatter: {
	            date: function (date, settings) {
	                if (!date) return '';
	                var day = date.getDate();
	                var month = date.getMonth() + 1;
	                var year = date.getFullYear();
	                return year + '/' + month + '/' + day;
	            }
	        }       
	    });
	});
    
</script>

@endsection