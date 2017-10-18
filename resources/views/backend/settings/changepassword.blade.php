@extends('backend.layouts.app')

@section('backend-content')

                            <i class="right chevron icon divider"></i>
                            <a class="section" href="{{ route('backend.settings.changepassword.get') }}">
                                Settings
                            </a>
                            <i class="arrow right icon divider"></i>
                            <div class="active section">Change Password</div>
                        </div> <!-- End Breadcrumb -->
                    </div> <!-- End Breadcrumb Column -->
                </div> <!-- End Breadcrumb Row -->
                <div class="row">
                    <div class="column">
                        <div class="ui basic compact segment" id="user-form">
                            <div class="ui top attached menu">
                                <div class="item">
                                    <h4 class="ui orange header">Change Password</h4>
                                </div>
                            </div>
                            <div class="ui bottom attached segment">
                                <form class="ui form" method="POST" action="{{ route('backend.settings.changepassword.post') }}">
                                    {{ csrf_field() }}
                                    <div class="field">
                                        <label for="password">Enter your new Password</label>
                                        <input type="password" name="password" placeholder="">
                                    </div>
                                    <div class="field">
                                        <label for="password_confirmation">Re-Enter your new Password</label>
                                        <input type="password" name="password_confirmation" placeholder="">
                                    </div>
                                    <div class="ui divider"></div>
                                    <div class="field">
                                        <label for="old_password">Enter your old Password</label>
                                        <input type="password" name="old_password" placeholder="">
                                    </div>
                                    <button class="ui small orange submit button" type="submit">
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