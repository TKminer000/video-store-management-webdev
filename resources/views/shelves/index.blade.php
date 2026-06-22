@extends('layouts.app')

@section('title', 'Shelves — Video Store')

@section('content')
<div class="container">
    <div class="page-header">
        <div class="page-title">
            <i class="bi bi-archive"></i> Shelves
        </div>
        <a href="{{ route('shelves.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Add Shelf
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($shelves as $shelf)
                <tr>
                    <td>{{ $shelf->shelf_id }}</td>
                    <td>{{ $shelf->category }}</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('shelves.edit', $shelf->shelf_id) }}" class="btn btn-warning">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            @if(session('role') == 'admin')
                            <form method="POST" action="{{ route('shelves.destroy', $shelf->shelf_id) }}">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger" onclick="return confirm('Delete this shelf?')">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" style="text-align:center;color:#475569;padding:2rem;">No shelves yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection