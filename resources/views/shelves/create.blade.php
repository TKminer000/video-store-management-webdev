@extends('layouts.app')

@section('title', 'Add Shelf — Video Store')

@section('content')
<div class="container">
    <div class="page-header">
        <div class="page-title">
            <i class="bi bi-archive"></i> Add Shelf
        </div>
        <a href="{{ route('shelves.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>
    <div class="form-card">
        <h2><i class="bi bi-plus-circle"></i> New Shelf</h2>
        <form method="POST" action="{{ route('shelves.store') }}">
            @csrf
            <label>Category</label>
            <input type="text" name="category" value="{{ old('category') }}" placeholder="e.g. Action">
            @error('category') <p class="error-msg">{{ $message }}</p> @enderror

            <div class="form-footer">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Save</button>
                <a href="{{ route('shelves.index') }}" class="btn btn-secondary"><i class="bi bi-x"></i> Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection