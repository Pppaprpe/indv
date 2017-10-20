@extends('backend.layouts.app')

@section('backend-content')

							<i class="right chevron icon divider"></i>
                            <a class="section" href="{{ route('backend.studentclass.list') }}">
                                Student Class Management
                            </a>
                            <i class="arrow right icon divider"></i>
                            <div class="active section">Edit Student Class</div>
                        </div> <!-- End Breadcrumb -->
                    </div> <!-- End Breadcrumb Column -->
                </div> <!-- End Breadcrumb Row -->
                <div class="row">
                    <div class="column">
                        <div class="ui basic compact segment">
                            <div class="ui top attached menu">
                                <div class="item">
                                    <h4 class="ui orange header">Edit Student Class</h4>
                                </div>
                            </div>
                            <div class="ui bottom attached segment">
                                <form class="ui form" method="POST" action="{{ route('backend.studentclass.edit.post', $stdclass->id) }}">
                                    {{ csrf_field() }}
                                    <div class="field">
                                    	<div class="ui left icon input">
                                    		<i class="student icon"></i>
                                    		<input type="text" name="name" value="{{ $stdclass->name }}" placeholder="Student Class">
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