@extends('frontend.layouts.app')

@section('frontend-content')
            
                <div class="caption">
                    <div class="col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2 col-xs-12">
                        <h2 class="animated fadeInLeftBig">Reset Password</h2>
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form class="form" method="POST" action="{{ url('/password/email') }}">
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
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg animated fadeInUpBig">
                                        Send Password Reset Link
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

