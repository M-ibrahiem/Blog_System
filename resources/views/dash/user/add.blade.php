@extends('dash.custom layouts.dash.app')

@section('title', 'Add New User')
@section('content')

{{-- <div class="row"> --}}
    <div class="col-xl-12">
        <section class="hk-sec-wrapper">
            <h5 class="hk-sec-title">Add New User</h5>
            <p class="mb-25">Fill the form to add a new user.</p>
            <div class="row">
                <div class="col-sm">
                    <form action="{{ route('dashboard.users.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" value="{{ old('name') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="role">Role</label>
                            <select name="role" class="form-control" id="role">
                                <option value="">Select a Role</option>
                                @foreach ($data as $user)
                                    <option value="{{ $user->role }}" {{ old('user') == $user->role ? 'selected' : '' }}>
                                        {{ $user->role }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" value="{{ old('email') }}">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Enter password">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirm password">
                        </div>

                        <button type="submit" class="btn btn-primary">Add User</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection
