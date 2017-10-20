@extends('backend.layouts.app')

@section('backend-content')

                            <i class="right chevron icon divider"></i>
                            <a class="section" href="{{ route('backend.admin.list') }}">
                                Administrator Management
                            </a>
                            <i class="arrow right icon divider"></i>
                            <div class="active section">Administrator List</div>
                        </div> <!-- End Breadcrumb -->
                    </div> <!-- End Breadcrumb Column -->
                </div> <!-- End Breadcrumb Row -->
                <div class="row">
                    <div class="column">
                        <div class="ui basic compact segment">
                            <h5 class="ui header">
                                Administrator List
                                <a class="ui orange label" href="{{ route('backend.admin.create.get') }}">
                                    <i class="plus icon"></i> Add new Administrator
                                </a>
                            </h5>
                            <table id="list-table" class="ui compact striped celled table">
                                <thead>
                                    <tr>
                                        <th><i class="hashtag icon"></i></th>
                                        <th>Firstname</th>
                                        <th>Lastname</th>
                                        <th>E-mail Address</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($admin as $index => $a)
                                        <tr>
                                            <td>{{ ++$index }}</td>
                                            <td>{{ $a->firstname }}</td>
                                            <td>{{ $a->lastname }}</td>
                                            <td>{{ $a->email }}</td>
                                            <td>{{ $a->role->name }}</td>
                                            <td>
                                                <form class="ui form" method="POST" action="{{ route('backend.admin.delete', $a->id) }}" onsubmit="confirmDelete()">
                                                    <input type="hidden" name="_method" value="delete">
                                                    {{ csrf_field() }}
                                                    <a class="ui orange tiny label" href="{{ route('backend.admin.edit.get', $a->id) }}">
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
                                            <td class="text-center" colspan="6">Data Not Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="6">
                                            <!-- Pagination -->
                                            @if ($admin->total() > 0)
                                                <div class="ui right floated mini pagination menu">
                                                    @php ($link_limit = 7)
                                                    <a class="item {{ $admin->currentPage() == 1 ? 'disabled' : '' }}" href="{{ $admin->url(1) }}">
                                                        <i class="left chevron icon"></i>
                                                    </a>
                                                    <a class="item {{ $admin->currentPage() == $admin->lastPage() ? 'disabled' : '' }}" href="{{ $admin->previousPageUrl() }}">
                                                        Prev
                                                    </a>
                                                    @for ($i = 1; $i <= $admin->lastPage(); $i++)
                                                        <?php
                                                            $half = floor($link_limit/2);
                                                            $from = $admin->currentPage() - $half;
                                                            $to = $admin->currentPage() + $half;
                                                            if ($admin->currentPage() < $half)
                                                            {
                                                                $to += $half - $admin->currentPage();
                                                            }
                                                            if ($admin->lastPage() - $admin->currentPage() < $half)
                                                            {
                                                                $from -= $half - ($admin->lastPage() - $admin->currentPage()) - 1;
                                                            }
                                                        ?>
                                                        @if ($from < $i && $i < $to)
                                                            <a class="item {{ $admin->currentPage() == $i ? 'active' : '' }}" href="{{ $admin->url($i) }}">
                                                                {{ $i }}
                                                            </a>
                                                        @endif
                                                    @endfor
                                                    <a class="item {{ $admin->currentPage() == $admin->lastPage() ? 'disabled' : '' }}" href="{{ $admin->nextPageUrl() }}">
                                                        Next
                                                    </a>
                                                    <a class="item {{ $admin->currentPage() == $admin->lastPage() ? 'disabled' : '' }}" href="{{ $admin->url($admin->lastPage()) }}">
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

{{ Session::put('listUrl', $admin->url($admin->currentPage())) }}
{{ Session::put('createUrl', $admin->url($admin->lastPage())) }}
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