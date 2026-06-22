@extends('layouts.app')

@section('title', 'Edit Actor — Video Store')

@section('content')
<div class="container">
    <div class="page-header">
        <div class="page-title">
            <i class="bi bi-people"></i> Edit Actor
        </div>
        <a href="{{ route('actors.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>
    <div class="form-card">
        <h2><i class="bi bi-pencil-square"></i> Edit Actor</h2>
        <form method="POST" action="{{ route('actors.update', $actor->actor_id) }}">
            @csrf @method('PUT')
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name', $actor->name) }}">
            @error('name') <p class="error-msg">{{ $message }}</p> @enderror

            <div class="form-footer">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Update</button>
                <a href="{{ route('actors.index') }}" class="btn btn-secondary"><i class="bi bi-x"></i> Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection@extends('layouts.app')

@section('title', 'Edit Actor — Video Store')

@section('content')
<div class="container">
    <div class="page-header">
        <div class="page-title">
            <i class="bi bi-people"></i> Edit Actor
        </div>
        <a href="{{ route('actors.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>
    <div class="form-card">
        <h2><i class="bi bi-pencil-square"></i> Edit Actor</h2>
        <form method="POST" action="{{ route('actors.update', $actor->actor_id) }}">
            @csrf @method('PUT')
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name', $actor->name) }}">
            @error('name') <p class="error-msg">{{ $message }}</p> @enderror

            <div class="form-footer">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Update</button>
                <a href="{{ route('actors.index') }}" class="btn btn-secondary"><i class="bi bi-x"></i> Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection