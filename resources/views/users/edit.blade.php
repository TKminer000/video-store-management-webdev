@extends('layouts.app')

@section('title', 'Edit User — Video Store')

@section('content')
<div class="container">
    <div class="page-header">
        <div class="page-title">
            <i class="bi bi-person-gear"></i> Edit User
        </div>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>
    <div class="form-card">
        <h2><i class="bi bi-pencil-square"></i> Edit User</h2>
        <form method="POST" action="{{ route('users.update', $user->id) }}">
            @csrf @method('PUT')
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}">
            @error('name') <p class="error-msg">{{ $message }}</p> @enderror

            <label>Username</label>
            <input type="text" value="{{ $user->username }}" disabled>
            <p class="hint">Username cannot be changed.</p>

            <label>New Password</label>
            <input type="password" name="password" placeholder="Leave blank to keep current">
            @error('password') <p class="error-msg">{{ $message }}</p> @enderror

            <label>Role</label>
            <select name="role">
                <option value="staff" {{ old('role', $user->role) == 'staff' ? 'selected' : '' }}>Staff</option>
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
            @error('role') <p class="error-msg">{{ $message }}</p> @enderror

            <div class="form-footer">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Update</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary"><i class="bi bi-x"></i> Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection