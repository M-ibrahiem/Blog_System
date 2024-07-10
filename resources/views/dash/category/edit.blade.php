@extends('dash.custom layouts.dash.app')

@section('title', 'Edit User')
@section('content')

<div class="col-xl-12">
    <section class="hk-sec-wrapper">
        <h5 class="hk-sec-title">Edit User</h5>
        <p class="mb-25">Update the form to edit the user details.</p>
        <div class="row">
            <div class="col-sm">
                <form action="{{ route('dashboard.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method("PUT")
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" value="{{ old('name', $user->name) }}">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="role">Role</label>
                        <select name="role" class="form-control" id="role">
                            <option value="">Select a Role</option>
                            @foreach ($data as $role)
                                <option value="{{ $role->role }}" {{ $user->role == $role->role ? 'selected' : '' }}>
                                    {{ $role->role }}
                                </option>
                            @endforeach
                        </select>
                        @error('role')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" value="{{ old('email', $user->email) }}">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password (Optional)</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Leave blank to keep current password">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirm password only if changing">
                    </div>

                    <button type="submit" class="btn btn-primary">Update User</button>
                </form>
            </div>
        </div>
    </section>
</div>

@endsection
