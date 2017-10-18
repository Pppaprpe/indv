@extends('backend.layouts.app')

@section('backend-content')

                            <i class="right chevron icon divider"></i>
                            <a class="section" href="{{ route('backend.studentclass.list') }}">
                                Student Class Management
                            </a>
                            <i class="arrow right icon divider"></i>
                            <div class="active section">Student Class List</div>
                        </div> <!-- End Breadcrumb -->
                    </div> <!-- End Breadcrumb Column -->
                </div> <!-- End Breadcrumb Row -->
                <div class="row">
                    <div class="column">
                        <div class="ui basic compact segment">
                            <h5 class="ui header">
                                Student Class List
                                <a class="ui orange label" href="{{ route('backend.studentclass.create.get') }}">
                                    <i class="plus icon"></i> Add New Student Class
                                </a>
                            </h5>
                            <table id="list-table" class="ui compact center aligned striped celled table">
                                <thead>
                                    <tr>
                                        <th><i class="hashtag icon"></i></th>
                                        <th>Name</th>
                                        <th>Amount of Students</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($stdclass as $index => $s)
                                        <tr>
                                            <td>{{ ++$index }}</td>
                                            <td>{{ $s->name }}</td>
                                            @php ($i = 0)
                                            @forelse ($stdcount as $c)
                                                @if ($s->id == $c->student_class)
                                                    <td>{{ $c->count }}</td>
                                                    @php ($countCheck = $c->count)
                                                    @break
                                                @elseif ($s->id != $c->student_class)
                                                    @php($i += 1)
                                                    @if ($i == count($stdcount))
                                                        <td>0</td>
                                                    @endif
                                                    @php ($countCheck = 0)
                                                @endif
                                            @empty
                                                <td>0</td>
                                                @php ($countCheck = 0)
                                            @endforelse
                                            <td>
                                                @if ($countCheck == 0)
                                                    <form class="ui form" method="POST" action="{{ route('backend.studentclass.delete', $s->id) }}" onsubmit="confirmDelete()">
                                                @else
                                                    <form class="ui form" method="POST" action="{{ route('backend.studentclass.delete', $s->id) }}" onsubmit="preventDelete()">
                                                @endif
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="_method" value="delete">
                                                    <a class="ui orange tiny label" href="{{ route('backend.studentclass.edit.get', $s->id) }}">
                                                        <i class="pencil icon"></i>
                                                        Edit
                                                    </a>
                                                    <button class="ui red tiny label">
                                                        <i class="remove icon"></i>
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="center aligned" colspan="4">
                                                Data Not Found
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="4">
                                            <!-- Pagination -->
                                            @if ($stdclass->total() > 0)
                                                <div class="ui right floated mini pagination menu">
                                                    @php ($link_limit = 7)
                                                    <a class="item {{ $stdclass->currentPage() == 1 ? 'disabled' : '' }}" href="{{ $stdclass->url(1) }}">
                                                        <i class="left chevron icon"></i>
                                                    </a>
                                                    <a class="item {{ $stdclass->currentPage() == $stdclass->lastPage() ? 'disabled' : '' }}" href="{{ $stdclass->previousPageUrl() }}">
                                                        Prev
                                                    </a>
                                                    @for ($i = 1; $i <= $stdclass->lastPage(); $i++)
                                                        <?php
                                                            $half = floor($link_limit/2);
                                                            $from = $stdclass->currentPage() - $half;
                                                            $to = $stdclass->currentPage() + $half;
                                                            if ($stdclass->currentPage() < $half)
                                                            {
                                                                $to += $half - $stdclass->currentPage();
                                                            }
                                                            if ($stdclass->lastPage() - $stdclass->currentPage() < $half)
                                                            {
                                                                $from -= $half - ($stdclass->lastPage() - $stdclass->currentPage()) - 1;
                                                            }
                                                        ?>
                                                        @if ($from < $i && $i < $to)
                                                            <a class="item {{ $stdclass->currentPage() == $i ? 'active' : '' }}" href="{{ $stdclass->url($i) }}">
                                                                {{ $i }}
                                                            </a>
                                                        @endif
                                                    @endfor
                                                    <a class="item {{ $stdclass->currentPage() == $stdclass->lastPage() ? 'disabled' : '' }}" href="{{ $stdclass->nextPageUrl() }}">
                                                        Next
                                                    </a>
                                                    <a class="item {{ $stdclass->currentPage() == $stdclass->lastPage() ? 'disabled' : '' }}" href="{{ $stdclass->url($stdclass->lastPage()) }}">
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
                               
{{ Session::put('listUrl', $stdclass->url($stdclass->currentPage())) }}
{{ Session::put('createUrl', $stdclass->url($stdclass->lastPage())) }}
<script type="text/javascript">
    function confirmDelete() {
        var result = confirm('Are you sure you want to delete?');
        if (result) {
            return true;
        } else {
            event.preventDefault();
        }
    }
    function preventDelete() {
		alert('Cannot delete class! This class already in used.');
		event.preventDefault();
	}
</script>

@endsection