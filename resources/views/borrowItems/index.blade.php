@extends('layouts.admin')

@section('content')

<style>
/* PAGE WRAPPER */
.page-wrap {
    padding: 20px;
    font-family: Arial, sans-serif;
}

/* HEADER */
.header-flex {
    display: flex;
    justify-content: space-between;
    gap: 20px;
    background: linear-gradient(135deg, #fff, #f9fafb);
    padding: 18px;
    border-radius: 14px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.06);
    border: 1px solid #f1f1f1;
}

.header-flex h4 {
    margin: 0;
    font-size: 18px;
    color: #1f2937;
}

/* SEARCH */
.search-box {
    display: flex;
    gap: 8px;
    margin-top: 10px;
}

.search-box input {
    padding: 10px;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    width: 260px;
    outline: none;
}

.search-box input:focus {
    border-color: #3b82f6;
}

/* BUTTONS */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 10px 14px;
    border-radius: 10px;
    border: none;
    cursor: pointer;
    text-decoration: none;
    font-size: 14px;
    gap: 6px;
}

/* COLORS */
.btn-primary { background: #3b82f6; color: #fff; }
.btn-success { background: #16a34a; color: #fff; }
.btn-warning { background: #f59e0b; color: #fff; }

/* HEADER ACTIONS */
.header-actions {
    display: flex;
    gap: 10px;
    align-items: start;
}

/* CARD */
.card {
    background: #fff;
    margin-top: 15px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}

.card-body {
    padding: 15px;
}

/* TABLE */
.table {
    width: 100%;
    border-collapse: collapse;
}

.table th {
    background: #f1f5f9;
    padding: 12px;
    text-align: left;
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

/* BADGE */
.badge {
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 12px;
    color: #fff;
}

.badge-success { background: #16a34a; }
.badge-warning { background: #f59e0b; }

/* RECEIVE MODE */
.receive-col {
    display: none;
}

.receive-active .receive-col {
    display: table-cell;
}

/* BULK ACTIONS */
#bulkActions {
    display: none;
    justify-content: flex-end;
    margin-top: 12px;
}

.receive-active #bulkActions {
    display: flex;
}

/* CHECKBOX */
input[type="checkbox"] {
    transform: scale(1.1);
}
</style>

<div class="page-wrap">

    <!-- HEADER -->
    <div class="header-flex">

        <div>
            <h4>📋 Borrowed Items</h4>
            <small>Manage and track borrowed store items</small>

            <form method="GET" action="{{ route('borrowItems.index') }}" class="search-box">
                <input type="text" name="search"
                       placeholder="Search borrower, item, company..."
                       value="{{ request('search') }}">

                <button class="btn btn-primary">🔍</button>
            </form>
        </div>

        <div class="header-actions">

            @can('view students')
            <button type="button" id="toggleReceive" class="btn btn-success">
                📥 Receive Items
            </button>
            @endcan

            <a href="{{ route('borrowItems.create') }}" class="btn btn-primary">
                ➕ Borrow Form
            </a>

        </div>

    </div>

    <!-- TABLE CARD -->
    <form method="POST" action="{{ route('borrowItems.bulkReturn') }}" id="receiveForm">
        @csrf

        <div class="card">
            <div class="card-body">

                <table class="table">

                    <thead>
                        <tr>
                            <th class="receive-col">
                                <input type="checkbox" onclick="toggleAll(this)">
                            </th>
                            <th>Force No</th>
                            <th>Borrower</th>
                            <th>Item</th>
                            <th>Qty</th>
                            <th>Company</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($borrows as $b)
                        <tr>

                            <td class="receive-col">
                                @if($b->status != 'returned')
                                    <input type="checkbox" name="ids[]" value="{{ $b->id }}">
                                @endif
                            </td>

                            <td>{{ $b->force_number }}</td>
                            <td>{{ $b->borrower_name }}</td>
                            <td>{{ $b->item->name }}</td>
                            <td>{{ $b->quantity }}</td>
                            <td>{{ $b->company }}</td>
                            <td>{{ $b->borrow_date }}</td>

                            <td>
                                @if($b->status == 'returned')
                                    <span class="badge badge-success">Returned</span>
                                @else
                                    <span class="badge badge-warning">Borrowed</span>
                                @endif
                            </td>

                        </tr>
                        @endforeach
                    </tbody>

                </table>

                <div id="bulkActions">
                    <button class="btn btn-success">
                        ✔ Mark Selected as Returned
                    </button>
                </div>

            </div>
        </div>

    </form>

</div>

<script>
let receiveMode = false;

document.getElementById('toggleReceive').addEventListener('click', function () {
    receiveMode = !receiveMode;
    document.body.classList.toggle('receive-active');

    this.innerHTML = receiveMode
        ? '❌ Cancel Receive'
        : '📥 Receive Items';
});

function toggleAll(source) {
    let checkboxes = document.querySelectorAll('input[name="ids[]"]');
    checkboxes.forEach(cb => cb.checked = source.checked);
}
</script>

@endsection