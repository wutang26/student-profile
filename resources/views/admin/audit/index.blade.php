@extends('layouts.admin')

@section('content')

<style>
/* =========================
   PAGE HEADER
========================= */
.page-title {
    font-size: 26px;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 18px;
    letter-spacing: 0.3px;
}

/* =========================
   CARD WRAPPER
========================= */
.card {
    background: #ffffff;
    border-radius: 14px;
    box-shadow: 0 8px 24px rgba(15, 23, 42, 0.08);
    overflow: hidden;
    border: 1px solid #eef2f7;
}

/* =========================
   TABLE WRAPPER
========================= */
.table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
    color: #334155;
}

/* HEADER */
.table thead {
    background: linear-gradient(90deg, #1d4ed8, #06b6d4);
    color: white;
}

.table th {
    padding: 14px 16px;
    text-align: left;
    font-weight: 600;
    font-size: 13px;
    letter-spacing: 0.4px;
    text-transform: uppercase;
}

/* BODY */
.table td {
    padding: 14px 16px;
    border-bottom: 1px solid #eef2f7;
    vertical-align: middle;
}

/* ROW HOVER */
.table tbody tr {
    transition: all 0.2s ease;
}

.table tbody tr:hover {
    background: #f8fafc;
    transform: scale(1.002);
}

/* =========================
   BADGE STYLE (optional upgrade for actions)
========================= */
.badge {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
    background: #e0f2fe;
    color: #0369a1;
}

/* =========================
   PAGINATION
========================= */
.pagination {
    margin-top: 18px;
    display: flex;
    justify-content: center;
    gap: 6px;
    flex-wrap: wrap;
}

.pagination a,
.pagination span {
    padding: 7px 11px;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    text-decoration: none;
    color: #0f172a;
    font-size: 13px;
    background: #fff;
    transition: 0.2s ease;
}

/* ACTIVE PAGE */
.pagination .active {
    background: linear-gradient(90deg, #1d4ed8, #06b6d4);
    color: #fff;
    border: none;
}

/* HOVER */
.pagination a:hover {
    background: #f1f5f9;
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
                   <td>{{ $log->user->name ?? 'System' }}</td>
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