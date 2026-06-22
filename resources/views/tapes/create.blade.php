@extends('layouts.app')

@section('title', 'Add Tape — Video Store')

@section('content')
<div class="container">
    <div class="page-header">
        <div class="page-title">
            <i class="bi bi-cassette"></i> Add Tape
        </div>
        <a href="{{ route('tapes.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>
    <div class="form-card">
        <h2><i class="bi bi-plus-circle"></i> New Tape</h2>
        <form method="POST" action="{{ route('tapes.store') }}">
            @csrf
            <label>Movie</label>
            <select name="movie_id">
                <option value="">-- Select Movie --</option>
                @foreach($movies as $movie)
                    <option value="{{ $movie->movie_id }}" {{ old('movie_id') == $movie->movie_id ? 'selected' : '' }}>
                        {{ $movie->title }}
                    </option>
                @endforeach
            </select>
            @error('movie_id') <p class="error-msg">{{ $message }}</p> @enderror

            <label>Format</label>
            <select name="format">
                <option value="">-- Select Format --</option>
                <option value="VHS" {{ old('format') == 'VHS' ? 'selected' : '' }}>VHS</option>
                <option value="Beta" {{ old('format') == 'Beta' ? 'selected' : '' }}>Beta</option>
            </select>
            @error('format') <p class="error-msg">{{ $message }}</p> @enderror

            <div class="form-footer">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Save</button>
                <a href="{{ route('tapes.index') }}" class="btn btn-secondary"><i class="bi bi-x"></i> Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection