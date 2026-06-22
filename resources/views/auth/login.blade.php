@extends('layouts.app')

@section('no-navbar', true)

@section('content')
<div class="login-wrap">
    <div class="login-card">
        <div class="brand">
            <i class="bi bi-film"></i>
            <h1>Video Store</h1>
            <p>Sign in to your account</p>
        </div>

        @if($errors->any())
            <div class="alert alert-error">
                <i class="bi bi-exclamation-circle"></i>
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <label>Username</label>
            <input type="text" name="username" value="{{ old('username') }}" placeholder="Enter username">

            <label>Password</label>
            <input type="password" name="password" placeholder="Enter password">

            <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center; padding: 0.7rem;">
                <i class="bi bi-box-arrow-in-right"></i> Sign In
            </button>
        </form>
    </div>
</div>
@endsection