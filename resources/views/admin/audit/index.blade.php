@extends('layouts.admin')

@section('content')

<style>
    /* PAGE TITLE */
    .page-title {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    /* CARD */
    .card {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        overflow-x: auto;
    }

    /* TABLE */
    .table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    .table thead {
        background: #f3f4f6;
    }

    .table th,
    .table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #e5e7eb;
    }

    .table tbody tr:hover {
        background: #f9fafb;
    }

    /* PAGINATION */
    .pagination {
        margin-top: 15px;
        display: flex;
        justify-content: center;
        gap: 5px;
    }

    .pagination a,
    .pagination span {
        padding: 6px 10px;
        border: 1px solid #d1d5db;
        border-radius: 5px;
        text-decoration: none;
        color: #111827;
        font-size: 13px;
    }

    .pagination .active {
        background: #2563eb;
        color: #fff;
        border-color: #2563eb;
    }
</style>

<h2 class="page-title">Audit Logs</h2>

<div class="card">

    <table class="table">
        <thead>
            <tr>
                <th>Performed By</th>
                <th>Action</th>
                <th>Description</th>
                <th>Time</th>
            </tr>
        </thead>

        <tbody>
            @foreach($logs as $log)
                <tr>
                    <td>{{ $log->user->name }}</td>
                    <td>{{ $log->action }}</td>
                    <td>{{ $log->description }}</td>
                    <td>{{ $log->created_at->diffForHumans() }}</td>
                </tr>
            @endforeach
        </tbody>

    </table>

</div>

<!-- PAGINATION -->
<div class="pagination">
    {{ $logs->links() }}
</div>

@endsection