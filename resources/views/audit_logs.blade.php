@extends('layouts.app')

@section('title', 'Audit Logs — Video Store')

@section('content')
<div class="container">
    <div class="page-header">
        <div class="page-title">
            <i class="bi bi-journal-text"></i> Audit Logs
        </div>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Action</th>
                    <th>Table</th>
                    <th>Details</th>
                    <th>Date & Time</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                <tr>
                    <td>{{ $log->id }}</td>
                    <td>
                        <span style="display:flex;align-items:center;gap:0.4rem;">
                            <i class="bi bi-person-circle" style="color:#818cf8;"></i>
                            {{ $log->username }}
                        </span>
                    </td>
                    <td>
                        @if($log->action == 'CREATE')
                            <span class="badge" style="background:#052e16;color:#86efac;border:1px solid #166534;">
                                <i class="bi bi-plus-circle"></i> CREATE
                            </span>
                        @elseif($log->action == 'UPDATE')
                            <span class="badge" style="background:#1e3a5f;color:#93c5fd;border:1px solid #1e40af;">
                                <i class="bi bi-pencil"></i> UPDATE
                            </span>
                        @else
                            <span class="badge" style="background:#2d0a0a;color:#fca5a5;border:1px solid #991b1b;">
                                <i class="bi bi-trash"></i> DELETE
                            </span>
                        @endif
                    </td>
                    <td>
                        <span style="color:#94a3b8;font-family:monospace;">{{ $log->table_affected }}</span>
                    </td>
                    <td>{{ $log->details }}</td>
                    <td style="color:#64748b;font-size:0.8rem;">{{ $log->created_at }}</td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align:center;color:#475569;padding:2rem;">No logs yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection