@extends('layouts.app')

@section('title', 'Dashboard — Video Store')

@section('content')
<div class="container">
    <div class="welcome-box">
        <h2>Welcome back, {{ session('name') }} :D</h2>
        <p>Manage your video store inventory below.</p>
    </div>

    <div class="manage-links">
        <a href="{{ route('movies.index') }}" class="dash-card">
            <i class="bi bi-film"></i>
            <h3>Movies</h3>
            <p>Manage movies</p>
        </a>
        <a href="{{ route('tapes.index') }}" class="dash-card">
            <i class="bi bi-cassette"></i>
            <h3>Tapes</h3>
            <p>Manage tapes</p>
        </a>
        <a href="{{ route('actors.index') }}" class="dash-card">
            <i class="bi bi-people"></i>
            <h3>Actors</h3>
            <p>Manage actors</p>
        </a>
        <a href="{{ route('shelves.index') }}" class="dash-card">
            <i class="bi bi-archive"></i>
            <h3>Shelves</h3>
            <p>Manage shelves</p>
        </a>
        <a href="{{ route('reports.index') }}" class="dash-card">
            <i class="bi bi-bar-chart"></i>
            <h3>Reports</h3>
            <p>Rental analytics</p>
        </a>
        <a href="{{ route('audit-logs') }}" class="dash-card">
            <i class="bi bi-journal-text"></i>
            <h3>Audit Logs</h3>
            <p>View activity</p>
        </a>
        @if(session('role') == 'admin')
        <a href="{{ route('users.index') }}" class="dash-card">
            <i class="bi bi-person-gear"></i>
            <h3>Users</h3>
            <p>Manage users</p>
        </a>
        @endif
    </div>

    <h3 class="section-title"><i class="bi bi-collection-play"></i> Available Movies for Rent</h3>

    <div class="movie-grid">
        @forelse($movies as $movie)
            @if($movie->available_copies > 0)
            <div class="movie-card">
                <div class="movie-card-img">
                    @if($movie->image)
                        <img src="{{ asset('storage/' . $movie->image) }}" alt="{{ $movie->title }}">
                    @else
                        <div class="movie-card-placeholder">
                            <i class="bi bi-film"></i>
                        </div>
                    @endif
                </div>
                <div class="movie-card-body">
                    <h4>{{ $movie->title }}</h4>
                    <p class="movie-card-meta">{{ $movie->category }} &middot; {{ $movie->year }}</p>
                    <div class="movie-card-stats">
                        <span class="stat available">{{ $movie->available_copies }} available</span>
                        <span class="stat rented">{{ $movie->rented_copies }} rented</span>
                    </div>
                </div>
            </div>
            @endif
        @empty
            <p style="color: #64748b; grid-column: 1 / -1; text-align: center; padding: 2rem;">No movies available for rent yet.</p>
        @endforelse
    </div>
</div>
@endsection
