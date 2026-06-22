@extends('layouts.app')

@section('title', 'Tapes — Video Store')

@section('content')
<div class="container">
    <div class="page-header">
        <div class="page-title">
            <i class="bi bi-cassette"></i> Tapes
        </div>
        <a href="{{ route('tapes.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Add Tape
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-error">
            <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-error">
            <i class="bi bi-exclamation-circle"></i> {{ $errors->first('error') }}
        </div>
    @endif

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Tape #</th>
                    <th>Movie</th>
                    <th>Format</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tapes as $tape)
                <tr>
                    <td>{{ $tape->tape_number }}</td>
                    <td>{{ $tape->movie_title }}</td>
                    <td>
                        <span class="badge {{ $tape->format == 'VHS' ? 'badge-vhs' : 'badge-beta' }}">
                            {{ $tape->format }}
                        </span>
                    </td>
                    <td>
                        <span class="badge {{ $tape->status == 'available' ? 'badge-available' : 'badge-rented' }}">
                            {{ ucfirst($tape->status) }}
                        </span>
                    </td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('tapes.edit', $tape->tape_number) }}" class="btn btn-warning">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            @if($tape->status == 'available')
                                <form method="POST" action="{{ route('tapes.rent', $tape->tape_number) }}">
                                    @csrf
                                    <button class="btn btn-primary"><i class="bi bi-play-circle"></i> Rent</button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('tapes.return', $tape->tape_number) }}">
                                    @csrf
                                    <button class="btn btn-secondary"><i class="bi bi-arrow-return-left"></i> Return</button>
                                </form>
                            @endif
                            @if(session('role') == 'admin')
                            <form method="POST" action="{{ route('tapes.destroy', $tape->tape_number) }}">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger" onclick="return confirm('Delete this tape?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" style="text-align:center;color:#475569;padding:2rem;">No tapes yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
