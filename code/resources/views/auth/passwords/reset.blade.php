@extends('frontend.layouts.app')

@section('frontend-content')
            
                <div class="caption-form">
                    <div class="col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2 col-xs-12">
                        <h2 class="animated fadeInLeftBig">Reset Password</h2>
                        <form class="form" method="POST" action="{{ url('/register') }}">
                            {{ csrf_field() }}
                            <div class="text-center">
                                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                    <input class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="Enter your E-mail Address">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                    <input id="password" class="form-control" type="password" name="password" value="{{ old('password') }}" placeholder="Enter your Password">
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Re-enter your password">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>
                                                {{ $errors->first('password_confirmation') }}
                                            </strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group form-group-lg">
                                    <button type="submit" class="btn btn-primary btn-lg animated fadeInUpBig">
                                        Reset Password
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
