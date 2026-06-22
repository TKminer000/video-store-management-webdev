@extends('layouts.app')

@section('title', 'Edit Movie — Video Store')

@section('content')
<div class="container">
    <div class="page-header">
        <div class="page-title">
            <i class="bi bi-film"></i> Edit Movie
        </div>
        <a href="{{ route('movies.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>
    <div class="form-card">
        <h2><i class="bi bi-pencil-square"></i> Edit Movie</h2>
        <form method="POST" action="{{ route('movies.update', $movie->movie_id) }}" enctype="multipart/form-data">
            @csrf @method('PUT')

            @if($movie->image)
            <div style="margin-bottom:1rem;">
                <img src="{{ asset('storage/' . $movie->image) }}" alt="{{ $movie->title }}" style="max-width:150px;border-radius:8px;border:1px solid #334155;">
            </div>
            @endif

            <label>Title</label>
            <input type="text" name="title" value="{{ old('title', $movie->title) }}">
            @error('title') <p class="error-msg">{{ $message }}</p> @enderror

            <label>Category</label>
            <select name="category">
                @foreach(['comedy','suspense','drama','action','SciFi'] as $cat)
                    <option value="{{ $cat }}" {{ old('category', $movie->category) == $cat ? 'selected' : '' }}>{{ ucfirst($cat) }}</option>
                @endforeach
            </select>
            @error('category') <p class="error-msg">{{ $message }}</p> @enderror

            <label>Director</label>
            <input type="text" name="director" value="{{ old('director', $movie->director) }}">
            @error('director') <p class="error-msg">{{ $message }}</p> @enderror

            <label>Year</label>
            <input type="number" name="year" value="{{ old('year', $movie->year) }}" min="1900" max="2099">
            @error('year') <p class="error-msg">{{ $message }}</p> @enderror

            <label>Image</label>
            <input type="file" name="image" accept="image/*">
            @error('image') <p class="error-msg">{{ $message }}</p> @enderror
            <p class="hint">Leave empty to keep current image. Accepted: jpeg, png, jpg, gif, webp (max 2MB)</p>

            <div class="form-footer">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Update</button>
                <a href="{{ route('movies.index') }}" class="btn btn-secondary"><i class="bi bi-x"></i> Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
