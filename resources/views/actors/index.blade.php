@extends('layouts.app')

@section('title', 'Actors — Video Store')

@section('content')
<div class="container">
    <div class="page-header">
        <div class="page-title">
            <i class="bi bi-people"></i> Actors
        </div>
        <a href="{{ route('actors.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Add Actor
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
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($actors as $actor)
                <tr>
                    <td>{{ $actor->actor_id }}</td>
                    <td>{{ $actor->name }}</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('actors.edit', $actor->actor_id) }}" class="btn btn-warning">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            @if(session('role') == 'admin')
                            <form method="POST" action="{{ route('actors.destroy', $actor->actor_id) }}">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger" onclick="return confirm('Delete this actor?')">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" style="text-align:center;color:#475569;padding:2rem;">No actors yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection