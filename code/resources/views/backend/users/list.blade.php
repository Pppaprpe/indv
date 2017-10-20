@extends('backend.layouts.app')

@section('backend-content')

                            <i class="right chevron icon divider"></i>
                            <a class="section" href="{{ route('backend.users.list') }}">
                                Student Management
                            </a>
                            <i class="arrow right icon divider"></i>
                            <div class="active section">Student List</div>
                        </div> <!-- End Breadcrumb -->
                    </div> <!-- End Breadcrumb Column -->
                </div> <!-- End Breadcrumb Row -->
                <div class="row">
                    <div class="column">
                        <div class="ui basic compact segment">
                            <h5 class="ui header">
                                Student List
                                <a class="ui orange label" href="{{ route('backend.users.create.get') }}">
                                    <i class="plus icon"></i> Add New Student
                                </a>
                            </h5>
                            <table id="list-table" class="ui compact striped celled table">
                                <thead>
                                    <tr>
                                        <th><i class="hashtag icon"></i></th>
                                        <th>Student ID</th>
                                        <th>Firstname</th>
                                        <th>Lastname</th>
                                        <th>Student Class</th>
                                        <th>E-mail Address</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($user as $index => $u)
                                        <tr>
                                            <td>{{ ++$index }}</td>
                                            <td>{{ $u->student_id }}</td>
                                            <td>{{ $u->firstname }}</td>
                                            <td>{{ $u->lastname }}</td>
                                            <td>{{ $u->student_class }}</td>
                                            <td>{{ $u->email }}</td>
                                            <td>
                                                @if ($u->user_status == 1)
                                                    <div class="ui green tiny label">
                                                @else
                                                    <div class="ui yellow tiny label">
                                                @endif
                                                    {{ $u->status->name }}
                                                </div>
                                            </td>
                                            <td>
                                                <form class="ui form" method="POST" action="{{ route('backend.users.delete', $u->user_id) }}" onsubmit="confirmDelete()">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="_method" value="delete">
                                                    @if (Auth::user()->user_role == 2 || Auth::user()->user_role == 4)
                                                        @if ($u->user_status == 1)
                                                            <a class="ui yellow tiny label" href="{{ route('backend.users.changestatus', [$u->user_id, 2]) }}">
                                                                <i class="ban icon"></i>
                                                                Inactive
                                                            </a>
                                                        @else
                                                            <a class="ui green tiny label" href="{{ route('backend.users.changestatus', [$u->user_id, 1]) }}">
                                                                <i class="check mark icon"></i>
                                                                Active
                                                            </a>
                                                        @endif
                                                    @endif
                                                    <a class="ui orange tiny label" href="{{ route('backend.users.edit.get', $u->user_id) }}">
                                                        <i class="pencil icon"></i>
                                                        Edit
                                                    </a>
                                                    <button class="ui red tiny label" type="submit">
                                                        <i class="remove icon"></i>
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="center aligned" colspan="8">Data Not Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="8">
                                            <!-- Pagination -->
                                            @if ($user->total() > 0)
                                                <div class="ui right floated mini pagination menu">
                                                    @php ($link_limit = 7)
                                                    <a class="item {{ $user->currentPage() == 1 ? 'disabled' : '' }}" href="{{ $user->url(1) }}">
                                                        <i class="left chevron icon"></i>
                                                    </a>
                                                    <a class="item {{ $user->currentPage() == $user->lastPage() ? 'disabled' : '' }}" href="{{ $user->previousPageUrl() }}">
                                                        Prev
                                                    </a>
                                                    @for ($i = 1; $i <= $user->lastPage(); $i++)
                                                        <?php
                                                            $half = floor($link_limit/2);
                                                            $from = $user->currentPage() - $half;
                                                            $to = $user->currentPage() + $half;
                                                            if ($user->currentPage() < $half)
                                                            {
                                                                $to += $half - $user->currentPage();
                                                            }
                                                            if ($user->lastPage() - $user->currentPage() < $half)
                                                            {
                                                                $from -= $half - ($user->lastPage() - $user->currentPage()) - 1;
                                                            }
                                                        ?>
                                                        @if ($from < $i && $i < $to)
                                                            <a class="item {{ $user->currentPage() == $i ? 'active' : '' }}" href="{{ $user->url($i) }}">
                                                                {{ $i }}
                                                            </a>
                                                        @endif
                                                    @endfor
                                                    <a class="item {{ $user->currentPage() == $user->lastPage() ? 'disabled' : '' }}" href="{{ $user->nextPageUrl() }}">
                                                        Next
                                                    </a>
                                                    <a class="item {{ $user->currentPage() == $user->lastPage() ? 'disabled' : '' }}" href="{{ $user->url($user->lastPage()) }}">
                                                        <i class="right chevron icon"></i>
                                                    </a>
                                                </div>
                                            @endif
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div> <!-- End Grid -->
        </div> <!-- End Container -->
    </div> <!-- End Pusher -->
                               
{{ Session::put('listUrl', $user->url($user->currentPage())) }}
{{ Session::put('createUrl', $user->url($user->lastPage())) }}
<script type="text/javascript">
    function confirmDelete() {
        var result = confirm('Are you sure you want to delete?');
        if (result) {
            return true;
        } else {
            event.preventDefault();
        }
    }
</script>

@endsection