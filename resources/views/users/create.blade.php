@extends('layouts.app')

@section('title', 'Add User — Video Store')

@section('content')
<div class="container">
    <div class="page-header">
        <div class="page-title">
            <i class="bi bi-person-gear"></i> Add User
        </div>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>
    <div class="form-card">
        <h2><i class="bi bi-plus-circle"></i> New User</h2>
        <form method="POST" action="{{ route('users.store') }}">
            @csrf
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. Harrie Parter">
            @error('name') <p class="error-msg">{{ $message }}</p> @enderror

            <label>Username</label>
            <input type="text" name="username" value="{{ old('username') }}" placeholder="e.g. rodahn123">
            @error('username') <p class="error-msg">{{ $message }}</p> @enderror

            <label>Password</label>
            <input type="password" name="password" placeholder=":>">
            @error('password') <p class="error-msg">{{ $message }}</p> @enderror

            <label>Role</label>
            <select name="role">
                <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Staff</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
            @error('role') <p class="error-msg">{{ $message }}</p> @enderror

            <div class="form-footer">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Save</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary"><i class="bi bi-x"></i> Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection