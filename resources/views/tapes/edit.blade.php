@extends('layouts.app')

@section('title', 'Edit Tape — Video Store')

@section('content')
<div class="container">
    <div class="page-header">
        <div class="page-title">
            <i class="bi bi-cassette"></i> Edit Tape
        </div>
        <a href="{{ route('tapes.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>
    <div class="form-card">
        <h2><i class="bi bi-pencil-square"></i> Edit Tape</h2>
        <form method="POST" action="{{ route('tapes.update', $tape->tape_number) }}">
            @csrf @method('PUT')
            <label>Movie</label>
            <select name="movie_id">
                @foreach($movies as $movie)
                    <option value="{{ $movie->movie_id }}" {{ old('movie_id', $tape->movie_id) == $movie->movie_id ? 'selected' : '' }}>
                        {{ $movie->title }}
                    </option>
                @endforeach
            </select>
            @error('movie_id') <p class="error-msg">{{ $message }}</p> @enderror

            <label>Format</label>
            <select name="format">
                <option value="VHS" {{ old('format', $tape->format) == 'VHS' ? 'selected' : '' }}>VHS</option>
                <option value="Beta" {{ old('format', $tape->format) == 'Beta' ? 'selected' : '' }}>Beta</option>
            </select>
            @error('format') <p class="error-msg">{{ $message }}</p> @enderror

            <div class="form-footer">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Update</button>
                <a href="{{ route('tapes.index') }}" class="btn btn-secondary"><i class="bi bi-x"></i> Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection