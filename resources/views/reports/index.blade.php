@extends('layouts.app')

@section('title', 'Reports — Video Store')

@section('content')
<div class="container">
    <div class="page-header">
        <div class="page-title">
            <i class="bi bi-bar-chart"></i> Rental Reports
        </div>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    <h3 class="section-title"><i class="bi bi-graph-up-arrow"></i> Most Rented Movies</h3>
    <div class="table-wrap" style="margin-bottom:2rem;">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Times Rented</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mostRented as $movie)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($movie->image)
                            <img src="{{ asset('storage/' . $movie->image) }}" alt="{{ $movie->title }}" class="table-thumb">
                        @else
                            <span style="color:#475569;font-size:0.75rem;">—</span>
                        @endif
                    </td>
                    <td>{{ $movie->title }}</td>
                    <td>{{ $movie->category }}</td>
                    <td><span class="badge badge-available">{{ $movie->rental_count }}x</span></td>
                </tr>
                @empty
                <tr><td colspan="5" style="text-align:center;color:#475569;padding:2rem;">No rental data yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <h3 class="section-title"><i class="bi bi-graph-down-arrow"></i> Least Rented Movies</h3>
    <div class="table-wrap" style="margin-bottom:2rem;">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Times Rented</th>
                </tr>
            </thead>
            <tbody>
                @forelse($leastRented as $movie)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($movie->image)
                            <img src="{{ asset('storage/' . $movie->image) }}" alt="{{ $movie->title }}" class="table-thumb">
                        @else
                            <span style="color:#475569;font-size:0.75rem;">—</span>
                        @endif
                    </td>
                    <td>{{ $movie->title }}</td>
                    <td>{{ $movie->category }}</td>
                    <td><span class="badge badge-rented">{{ $movie->rental_count }}x</span></td>
                </tr>
                @empty
                <tr><td colspan="5" style="text-align:center;color:#475569;padding:2rem;">No rental data yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <h3 class="section-title"><i class="bi bi-clock-history"></i> Currently Rented</h3>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Tape #</th>
                    <th>Movie</th>
                    <th>Rented By</th>
                    <th>Rented At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($currentlyRented as $rental)
                <tr>
                    <td>{{ $rental->tape_number }}</td>
                    <td>{{ $rental->title }}</td>
                    <td>{{ $rental->staff_name }}</td>
                    <td>{{ $rental->rented_at }}</td>
                </tr>
                @empty
                <tr><td colspan="4" style="text-align:center;color:#475569;padding:2rem;">No tapes currently rented.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
