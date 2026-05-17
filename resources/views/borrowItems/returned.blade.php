@extends('layouts.admin')

@section('content')

<style>
/* PAGE WRAPPER */
.page-wrap {
    padding: 20px;
    font-family: Arial, sans-serif;
}

/* HEADER */
.header {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
}

.header h4 {
    margin: 0;
    font-size: 18px;
    color: #1f2937;
}

/* CARD */
.table-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.06);
    padding: 15px;
}

/* TABLE */
.table {
    width: 100%;
    border-collapse: collapse;
}

.table th {
    background: #f1f5f9;
    text-align: left;
    padding: 12px;
    font-size: 13px;
    color: #334155;
}

.table td {
    padding: 12px;
    border-top: 1px solid #e2e8f0;
    font-size: 14px;
}

.table tr:hover {
    background: #f9fafb;
}

/* BADGES */
.badge {
    display: inline-block;
    padding: 5px 10px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 600;
}

/* STATUS COLORS */
.badge-returned {
    background: #dcfce7;
    color: #166534;
}

.badge-borrowed {
    background: #fef3c7;
    color: #92400e;
}
</style>

<div class="page-wrap">

    <!-- HEADER -->
    <div class="header">
        <h4>📦 Returned Items</h4>
    </div>

    <!-- TABLE CARD -->
    <div class="table-card">

        <table class="table">

            <thead>
                <tr>
                    <th>Force No</th>
                    <th>Borrower</th>
                    <th>Item</th>
                    <th>Qty</th>
                    <th>Company</th>
                    <th>Borrow Date</th>
                    <th>Return Date</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse($records as $r)
                <tr>
                    <td>{{ $r->force_number }}</td>
                    <td>{{ $r->borrower_name }}</td>
                    <td>{{ $r->item->name }}</td>
                    <td>{{ $r->quantity }}</td>
                    <td>{{ $r->company }}</td>
                    <td>{{ $r->borrow_date }}</td>
                    <td>{{ $r->return_date }}</td>

                    <td>
                        @if($r->status == 'returned')
                            <span class="badge badge-returned">Returned</span>
                        @else
                            <span class="badge badge-borrowed">Borrowed</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align:center; padding:20px; color:#94a3b8;">
                        No records found
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>

    </div>

</div>

@endsection