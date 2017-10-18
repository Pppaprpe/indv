@extends('frontend.layouts.app')

@section('frontend-content')

                <div class="caption-form">
 			        <div class="col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2 col-xs-12">
                        <h2 class="animated fadeInLeftBig">My Profile</h2>
                        <form class="form" method="POST" action="{{ route('frontend.profile.post') }}">
                            {{ csrf_field() }}
                            <div class="text-center">
                                @if ($user)
                                    <div class="form-group">
                                        <input class="form-control {{ $errors->has('student_id') ? 'has-error' : '' }}" type="text" name="student_id" value="{{ $user->student_id }}" placeholder="Enter your Student ID">
                                        @if ($errors->has('student_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('student_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('student_class') ? 'has-error' : '' }}">
                                        <select class="form-control" id="student_class" name="student_class">
                                            <option value="">Choose your Class</option>
                                            @foreach ($stdclass as $c)
                                                <option value="{{ $c->id }}" {{ ( $user->student_class == $c->id ? 'selected' : '' ) }}>{{ $c->name }}</option>
                                            @endforeach
                                            @if ($errors->has('student_class'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('student_class') }}</strong>
                                                </span>
                                            @endif
                                    </select>
                                    </div>
                                    <div class="form-group {{ $errors->has('mobile_no') ? 'has-error' : '' }}">
                                        <input class="form-control" type="text" name="mobile_no" value="{{ $user->mobile_no }}" placeholder="Enter your Mobile Number">
                                        @if ($errors->has('mobile_no'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('mobile_no') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                @else
                                    <div class="form-group">
                                        <input class="form-control {{ $errors->has('student_id') ? 'has-error' : '' }}" type="text" name="student_id" value="{{ old('student_id') }}" placeholder="Enter your Student ID">
                                        @if ($errors->has('student_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('student_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('student_class') ? 'has-error' : '' }}">
                                        <select class="form-control" id="student_class" name="student_class">
                                            <option value="">Choose your Class</option>
                                            @foreach ($stdclass as $c)
                                                <option value="{{ $c->id }}" {{ ( old('student_class') == $c->id ? 'selected' : '' ) }}>{{ $c->name }}</option>
                                            @endforeach
                                            @if ($errors->has('student_class'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('student_class') }}</strong>
                                                </span>
                                            @endif
                                    </select>
                                    </div>
                                    <div class="form-group {{ $errors->has('mobile_no') ? 'has-error' : '' }}">
                                        <input class="form-control" type="text" name="mobile_no" value="{{ old('mobile_no') }}" placeholder="Enter your Mobile Number">
                                        @if ($errors->has('mobile_no'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('mobile_no') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                @endif
                                <div class="form-group form-group-lg">
                                    <button type="submit" class="btn btn-primary btn-lg animated fadeInUpBig">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- End of Caption -->
            </div>
        </div>
    </header>
    
@endsection