@extends('backend.layouts.app')

@section('backend-content')
    						
                        </div> <!-- End Breadcrumb -->
                    </div> <!-- End Column -->
                </div> <!-- End Row -->
                <div class="row">
                	<div class="column">
                		<div class="ui three cards">
                        @if (Auth::user()->user_role < 4)
                            <div class="ui card">
                                <div class="content">
                                    <div class="ui header">
                                        <i class="plane icon"></i>
                                        Booking Management
                                    </div>
                                    <div class="ui divider"></div>
                                    <h4 class="ui header">
                                        Booking Today
                                    </h4>
                                    <div class="ui small feed">
                                        <div class="event">
                                            <div class="content">
                                                <div class="summary">
                                                    <div class="ui middle aligned divided list">
                                                        @forelse ($booking as $b)
                                                        <a class="item" href="{{ route('backend.bookings.list') }}">
                                                            <div class="right floated content">
                                                                @if ($b->booking_status < 3)
                                                                    <div class="ui mini green label">
                                                                @elseif ($b->booking_status == 5)
                                                                    <div class="ui mini red label">
                                                                @else
                                                                    <div class="ui mini black label">
                                                                @endif
                                                                    {{ $b->status->name }}
                                                                </div>
                                                            </div>
                                                            <div class="left floated content">
                                                                <label class="ui grey mini circular label">
                                                                    {{ date('h:i A', strtotime($b->updated_at)) }}
                                                                </label>
                                                                {{ $b->user->firstname . ' ' . $b->user->lastname }}
                                                            </div>
                                                            <div class="center aligned content">
                                                                {{ $b->sort->name }}
                                                            </div>
                                                        </a>
                                                        @empty
                                                            <div class="item">
                                                                <div class="center aligned content">
                                                                    Nothing Update Today!
                                                                </div>
                                                            </div>
                                                        @endforelse
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="ui header">
                                        Booking List
                                        <a class="ui mini blue label" href="{{ route('backend.bookings.list') }}">Click</a>
                                    </h4>
                                    <h4 class="ui header">
                                        Booking Report
                                        <a class="ui mini blue label" href="{{ route('backend.reports.select') }}">Click</a>
                                    </h4>
                                </div>
                            </div>
                        @endif
                            <div class="ui card">
                                <div class="content">
                                    <div class="ui header">
                                        <i class="user icon"></i>
                                        Student Management
                                    </div>
                                    <div class="ui divider"></div>
                                    <h4 class="ui header">
                                        Student Today
                                    </h4>
                                    <div class="ui small feed">
                                        <div class="event">
                                            <div class="content">
                                                <div class="summary">
                                                    <div class="ui middle aligned divided list">
                                                        @forelse ($user as $u)
                                                        <a class="item" href="{{ route('backend.users.list') }}">
                                                            <div class="right floated content">
                                                                <div class="ui mini green label">
                                                                    Register
                                                                </div>
                                                            </div>
                                                            <div class="left floated content">
                                                                <label class="ui grey mini circular label">
                                                                    {{ date('h:i A', strtotime($u->created_at)) }}
                                                                </label>
                                                               {{ $u->firstname . ' ' . $u->lastname }}
                                                            </div>
                                                            <div class="center aligned content">
                                                                {{ $u->role->name }}
                                                            </div>
                                                        </a>
                                                        @empty
                                                            <div class="item">
                                                                <div class="center aligned content">
                                                                    Nothing Update Today!
                                                                </div>
                                                            </div>
                                                        @endforelse
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="ui header">
                                        Student List
                                        <a class="ui mini blue label" href="{{ route('backend.users.list') }}">Click</a>
                                    </h4>
                                    <h4 class="ui header">
                                        Add new Student
                                        <a class="ui mini blue label" href="{{ route('backend.users.create.get') }}">Click</a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="ui three cards">
                            <div class="ui card">
                                <div class="content">
                                    <div class="ui header">
                                        <i class="student icon"></i>
                                        Student Class Management
                                    </div>
                                    <div class="ui divider"></div>
                                    <h4 class="ui header">
                                        Student Class Today
                                    </h4>
                                    <div class="ui small feed">
                                        <div class="event">
                                            <div class="content">
                                                <div class="summary">
                                                    <div class="ui middle aligned divided list">
                                                        @forelse ($stdclass as $s)
                                                        <a class="item" href="{{ route('backend.studentclass.list') }}">
                                                            <div class="right floated content">
                                                                <div class="ui mini yellow label">
                                                                    Update
                                                                </div>
                                                            </div>
                                                            <div class="left floated content">
                                                                <label class="ui grey mini circular label">
                                                                    {{ date('h:i A', strtotime($s->created_at)) }}
                                                                </label>
                                                               {{ $s->firstname . ' ' . $s->lastname }}
                                                            </div>
                                                            <div class="center aligned content">
                                                                {{ $s->name }}
                                                            </div>
                                                        </a>
                                                        @empty
                                                            <div class="item">
                                                                <div class="center aligned content">
                                                                    Nothing Update Today!
                                                                </div>
                                                            </div>
                                                        @endforelse
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="ui header">
                                        Student Class List
                                        <a class="ui mini blue label" href="{{ route('backend.studentclass.list') }}">Click</a>
                                    </h4>
                                    <h4 class="ui header">
                                        Add new Student Class
                                        <a class="ui mini blue label" href="{{ route('backend.studentclass.create.get') }}">Click</a>
                                    </h4>
                                </div>
                            </div>
                            <div class="ui card">
                                <div class="content">
                                    <div class="ui header">
                                        <i class="setting icon"></i>
                                        Setting
                                    </div>
                                    <div class="ui divider"></div>
                                    <h4 class="ui header">
                                        Change your Password
                                        <a class="ui mini blue label" href="{{ route('backend.settings.changepassword.get') }}">Click</a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                	</div>
                </div>
            </div> <!-- End Grid -->
        </div> <!-- End Container -->
    </div> <!-- End Pusher -->
    
@endsection