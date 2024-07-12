@extends('custom layouts.dash.app')

@push('custom_css')
    <link href="https://cdn.datatables.net/v/bs4/jq-3.7.0/dt-2.0.8/datatables.min.css" rel="stylesheet">
@endpush
@push('custom_js')
    <script src="https://cdn.datatables.net/v/bs4/jq-3.7.0/dt-2.0.8/datatables.min.js"></script>
    <script>
        let table = new DataTable('#usersTable');
    </script>
@endpush
@section('title', 'Users')
@section('content')

    {{-- <div class="row"> --}}
    <div class="col-xl-12">
        <section class="hk-sec-wrapper">
            <h5 class="hk-sec-title">Users</h5>
            <p class="mb-25">List of all Users</p>
            <div class="row">
                <div class="col-sm">
                    <a href="{{ route('dashboard.users.create') }}" class="btn btn-info mb-3">Add New</a>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="usersTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>name</th>
                                    <th>role</th>
                                    <th>email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $user)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>

                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>{{ $user->email }}</td>

                                        @if($user->deleted_at)
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('dashboard.users.restore', $user->id) }}"
                                                    class="btn btn-icon btn-secondary btn-icon-style-3">
                                                    <span class="btn-icon-wrap"><i class="fa fa-pencil"></i></span>
                                                </a>
                                                <form action="{{ route('dashboard.users.erase', $user->id) }}"
                                                    method="POST" style="display: inline;">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-icon btn-info btn-icon-style-3"
                                                        onclick="return confirm('Are you sure you want to delete this users?')">
                                                        <span class="btn-icon-wrap"><i class="icon-trash"></i></span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                        @else
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('dashboard.users.edit', $user->id) }}"
                                                    class="btn btn-icon btn-secondary btn-icon-style-1 mr-2">
                                                    <span class="btn-icon-wrap"><i class="fa fa-pencil"></i></span> Edit
                                                </a>
                                                <form action="{{ route('dashboard.users.destroy', $user->id) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-icon btn-danger btn-icon-style-1"
                                                        onclick="return confirm('Are you sure you want to delete this users?')">
                                                        <span class="btn-icon-wrap"><i class="icon-trash"></i></span> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
    </div>

@endsection
