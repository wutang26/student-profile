@extends('layouts.admin')

@section('content')

<style>
/* PAGE WRAPPER */
.page-wrap {
    padding: 20px;
    font-family: Arial, sans-serif;
}

/* TITLE */
.page-title {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 15px;
    color: #0f172a;
}

/* CARD */
.card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 6px 18px rgba(15,23,42,0.06);
    overflow: hidden;
    border: 1px solid #eef2f7;
}

/* TABLE */
.table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}

.table thead {
    background: linear-gradient(90deg, #1d4ed8, #06b6d4);
    color: #fff;
}

.table th {
    padding: 14px;
    text-align: left;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.table td {
    padding: 14px;
    border-bottom: 1px solid #eef2f7;
    color: #334155;
}

.table tbody tr:hover {
    background: #f8fafc;
}

/* BADGE */
.badge {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 999px;
    font-size: 12px;
    background: #e0f2fe;
    color: #0369a1;
}

/* PAGINATION (CUSTOM OFFLINE) */
.pagination {
    margin-top: 18px;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 6px;
}

.pagination a,
.pagination span {
    padding: 7px 11px;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    text-decoration: none;
    font-size: 13px;
    color: #0f172a;
    background: #fff;
}

/* ACTIVE PAGE */
.pagination .active span {
    background: linear-gradient(90deg, #1d4ed8, #06b6d4);
    color: #fff;
    border: none;
}

/* HOVER */
.pagination a:hover {
    background: #f1f5f9;
}
.table thead {
    background: #1e3a8a; /* solid professional blue */
}

.table th {
    padding: 14px;
    text-align: left;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.6px;
    color: #ffffff;
    border-right: 1px solid rgba(255,255,255,0.15);
}

/* last column cleaner */
.table th:last-child {
    border-right: none;
}
.table tbody tr:nth-child(even) {
    background: #f8fafc;
}

.table tbody tr:hover {
    background: #e0f2fe;
}
</style>

<div class="page-wrap">

    <!-- TITLE -->
    <h2 class="page-title">Audit Logs</h2>

    <!-- CARD -->
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
                @forelse($logs as $log)
                <tr>
                    <td>{{ $log->user->name ?? 'System' }}</td>
                    <td>{{ $log->action }}</td>
                    <td>{{ $log->description }}</td>
                    <td>{{ $log->created_at->diffForHumans() }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align:center; padding:20px; color:#94a3b8;">
                        No audit logs found
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>

    </div>

    <!-- PAGINATION -->
    <div class="pagination">
        {{ $logs->links() }}
    </div>

</div>

@endsection