@extends('backend.layouts.app')

@section('backend-content')

                            <i class="right chevron icon divider"></i>
                            <a class="section" href="{{ route('backend.users.list') }}">
                                Student Management
                            </a>
                            <i class="arrow right icon divider"></i>
                            <div class="active section">Add new Student</div>
                        </div> <!-- End Breadcrumb -->
                    </div> <!-- End Breadcrumb Column -->
                </div> <!-- End Breadcrumb Row -->
                <div class="row">
                    <div class="column">
                        <div class="ui basic compact segment" id="user-form">
                            <div class="ui top attached menu">
                                <div class="item">
                                    <h4 class="ui orange header">Add new Student</h4>
                                </div>
                            </div>
                            <div class="ui bottom attached segment">
                                <form class="ui form" method="POST" action="{{ route('backend.users.create.post') }}">
                                    {{ csrf_field() }}
                                    <div class="two fields">
                                        <div class="field">
                                            <div class="ui left icon input">
                                                <i class="user icon"></i>
                                                <input type="text" name="firstname" value="{{ old('firstname') }}" placeholder="Firstname">
                                            </div>
                                        </div>
                                        <div class="field">
                                            <div class="ui left icon input">
                                                <i class="user icon"></i>
                                                <input type="text" name="lastname" value="{{ old('lastname') }}" placeholder="Lastname">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="two fields">
                                        <div class="ten wide field {{ $errors->has('email') ? 'has-error' : '' }}">
                                            <div class="ui left icon input">
                                                <i class="mail icon"></i>
                                                <input type="email" name="email" value="{{ old('email') }}" placeholder="E-mail Address">
                                            </div>
                                            @if ($errors->has('email'))
                                                <div class="ui red mini message">This E-mail has already been taken.</div>
                                            @endif
                                        </div>
                                        <div class="six wide field {{ $errors->has('mobile_no') ? 'has-error' : '' }}">
                                            <div class="ui left icon input">
                                                <i class="mobile icon"></i>
                                                <input type="text" name="mobile_no" value="{{ old('mobile_no') }}" placeholder="Mobile Number">
                                            </div>
                                            @if ($errors->has('mobile_no'))
                                                <div class="ui red mini message">This Mobile Number has already been taken.</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="two fields">
                                        <div class="field {{ $errors->has('student_id') ? 'has-error' : '' }}">
                                            <div class="ui left icon input">
                                                <i class="student icon"></i>
                                                <input type="text" name="student_id" value="{{ old('student_id') }}" placeholder="Student ID">
                                            </div>
                                            @if ($errors->has('student_id'))
                                                <div class="ui red mini message">This Student ID has already been taken.</div>
                                            @endif
                                        </div>
                                        <div class="field">
                                            <select class="ui selection dropdown" name="student_class">
                                                <option class="default text" value="{{ old('student_class') }}">
                                                    Student Class
                                                </option>
                                                @foreach ($stdclass as $s)
                                                    <option value="{{ $s->id }}">
                                                        {{ $s->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="two fields">
                                        <div class="field">
                                            <div class="ui left icon input">
                                                <i class="lock icon"></i>
                                                <input type="password" name="password" value="" placeholder="Password">
                                            </div>
                                        </div>
                                        <div class="field">
                                            <div class="ui left icon input">
                                                <i class="lock icon"></i>
                                                <input type="password" name="password_confirmation" value="" placeholder="Re-enter Password">
                                            </div>
                                        </div>
                                    </div>
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

@endsection