@extends('admin.layouts.master')

@section('main_content')
<div class="row">

    <div class="container col-md-6">
        <h2>Edit Profile</h2>
        @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" disabled name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </div>
            </div>
        </form>
    </div>

    <div class="container mt-4 col-md-6">
        <h2>Edit Password</h2>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="current_password">Current Password:</label>
                        <input type="password" name="current_password" class="form-control" required>
                        @error('current_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="password">New Password:</label>
                        <input type="password" name="password" class="form-control" required>
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="password_confirmation">Confirm New Password:</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                        @error('password_confirmation')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Update Password</button>
                </div>
            </div>
        </form>
    </div>
        
</div>
@endsection
