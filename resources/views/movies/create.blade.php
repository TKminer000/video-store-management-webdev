@extends('layouts.app')

@section('title', 'Add Movie — Video Store')

@section('content')
<div class="container">
    <div class="page-header">
        <div class="page-title">
            <i class="bi bi-film"></i> Add Movie
        </div>
        <a href="{{ route('movies.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>
    <div class="form-card">
        <h2><i class="bi bi-plus-circle"></i> New Movie</h2>
        <form method="POST" action="{{ route('movies.store') }}" enctype="multipart/form-data">
            @csrf
            <label>Title</label>
            <input type="text" name="title" value="{{ old('title') }}" placeholder="e.g. The Matrix">
            @error('title') <p class="error-msg">{{ $message }}</p> @enderror

            <label>Category</label>
            <select name="category">
                <option value="">-- Select Category --</option>
                @foreach(['comedy','suspense','drama','action','SciFi'] as $cat)
                    <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>{{ ucfirst($cat) }}</option>
                @endforeach
            </select>
            @error('category') <p class="error-msg">{{ $message }}</p> @enderror

            <label>Director</label>
            <input type="text" name="director" value="{{ old('director') }}" placeholder="e.g. Christopher Nolan">
            @error('director') <p class="error-msg">{{ $message }}</p> @enderror

            <label>Year</label>
            <input type="number" name="year" value="{{ old('year') }}" placeholder="e.g. 2024" min="1900" max="2099">
            @error('year') <p class="error-msg">{{ $message }}</p> @enderror

            <label>Image</label>
            <input type="file" name="image" accept="image/*">
            @error('image') <p class="error-msg">{{ $message }}</p> @enderror
            <p class="hint">Optional. Accepted: jpeg, png, jpg, gif, webp (max 2MB)</p>

            <div class="form-footer">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Save</button>
                <a href="{{ route('movies.index') }}" class="btn btn-secondary"><i class="bi bi-x"></i> Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
