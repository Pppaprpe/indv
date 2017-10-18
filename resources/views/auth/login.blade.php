@extends('frontend.layouts.app')

@section('frontend-content')
            
                <div class="caption-form">
                    <div class="col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2 col-xs-12">
                        <h2 class="animated fadeInLeftBig">Login to your Account</h2>
                        <form class="form" method="POST" action="{{ url('/login') }}">
                            {{ csrf_field() }}
                            <div class="text-center">
                                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                    <input class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="E-mail Address">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                    <input class="form-control" type="password" name="password" value="{{ old('password') }}" placeholder="Password">
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <div class="checkbox">
                                        <h4>
                                            <input type="checkbox" name="remember">
                                            <strong>Remember Me</strong>
                                        </h4>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg animated fadeInUpBig">
                                        Login
                                    </button>
                                </div>
                                <div class="form-group">
                                    <h4>
                                        <a href="{{ url('/password/reset') }}">
                                            <strong>Forget Your Password?</strong>
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- End of Caption -->
            </div>
        </div>
    </header>
            
@endsection
