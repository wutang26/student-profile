@extends('layouts.admin')

@section('content')
<style>
.header-flex {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    width: 100%;
    background: linear-gradient(135deg, #ffffff, #f9fafb);
    padding: 18px 20px;
    border-radius: 14px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.06);
    border: 1px solid #f1f1f1;
}

/* TITLE */
.header-flex h4 {
    font-weight: 700;
    color: #1f2937;
}

/* SEARCH BOX */
.search-box {
    margin-top: 12px;
    display: flex;
    gap: 10px;
}

.search-box input {
    border-radius: 10px;
    border: 1px solid #e5e7eb;
    padding: 10px 12px;
    transition: 0.2s;
    box-shadow: none;
}

.search-box input:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59,130,246,0.15);
}

/* RIGHT BUTTONS */
.header-actions {
    display: flex;
    gap: 12px;
}

/* MODERN BUTTON BASE */
.header-actions .btn {
    display: flex;
    align-items: center;
    gap: 6px;
    border-radius: 12px;
    font-weight: 600;
    padding: 10px 14px;
    transition: 0.25s ease;
    border: none;
}

/* RECEIVE BUTTON (GREEN GRADIENT) */
.btn-receive {
    background: linear-gradient(135deg, #16a34a, #22c55e);
    color: white;
    box-shadow: 0 4px 12px rgba(34,197,94,0.25);
}

.btn-receive:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 18px rgba(34,197,94,0.35);
}

/* BORROW BUTTON (BLUE GRADIENT) */
.btn-borrow {
    background: linear-gradient(135deg, #2563eb, #3b82f6);
    color: white;
    box-shadow: 0 4px 12px rgba(59,130,246,0.25);
    text-decoration:none;
}

.btn-borrow:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 18px rgba(59,130,246,0.35);
}

/* RECEIVE MODE */
.receive-col {
    display: none;
}

.receive-active .receive-col {
    display: table-cell;
}

/* BULK ACTION */
#bulkActions {
    display: none;
}

.receive-active #bulkActions {
    display: flex;
}

/* TABLE HOVER */
table tbody tr:hover {
    background: #f9fafb;
}
</style>

<div class="container-fluid">

    <!-- HEADER -->
    <div class="header-flex mb-3">

        <!-- LEFT -->
        <div>
            <h4 class="mb-0">📋 Borrowed Items</h4>
            <small class="text-muted">Manage and track borrowed store items</small>

            <!-- SEARCH -->
            <form method="GET" action="{{ route('borrowItems.index') }}" class="search-box">
                <input type="text" name="search" class="form-control"
                       placeholder="Search borrower, item, company..."
                       value="{{ request('search') }}">
               <button class="btn btn-primary" style="border-radius:10px;">
                <i class="bi bi-search"></i>
            </button>
            </form>
        </div>

        <!-- RIGHT -->
        <div class="header-actions">

    <button type="button" id="toggleReceive" class="btn btn-receive">
        <i class="bi bi-arrow-down-circle"></i>
        Receive Items
    </button>

    <a href="{{ route('borrowItems.create') }}" class="btn btn-borrow">
        <i class="bi bi-plus-circle"></i>
        Borrow Form
    </a>

</div>

    </div>

    <!-- BULK FORM -->
    <form method="POST" action="{{ route('borrowItems.bulkReturn') }}" id="receiveForm">
        @csrf

        <div class="card shadow-sm">
            <div class="card-body">

                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th class="receive-col">
                                <input type="checkbox" onclick="toggleAll(this)">
                            </th>
                            <th>Borrower</th>
                            <th>Force No</th>
                            <th>Item</th>
                            <th>Qty</th>
                            <th>Company</th>
                            <th>Date</th>
                            <th>Status</th>
                            <!-- <th>Returned</th>   //Make this visible once user click receive button -->
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

                            <td>{{ $b->borrower_name }}</td>
                            <td>{{ $b->force_number }}</td>
                            <td>{{ $b->item->name }}</td>
                            <td>{{ $b->quantity }}</td>
                            <td>{{ $b->company }}</td>
                            <td>{{ $b->borrow_date }}</td>

                            <td>
                                @if($b->status == 'returned')
                                    <span class="badge bg-success">Returned</span>
                                @else
                                    <span class="badge bg-warning">Borrowed</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>

                <!-- BULK ACTION -->
                <div id="bulkActions" class="justify-content-end mt-3">
                    <button class="btn btn-success">
                        <i class="bi bi-check-circle"></i> Mark Selected as Returned
                    </button>
                </div>

            </div>
        </div>

    </form>

</div>

<script>
// TOGGLE RECEIVE MODE
let receiveMode = false;

document.getElementById('toggleReceive').addEventListener('click', function () {

    receiveMode = !receiveMode;

    document.body.classList.toggle('receive-active');

    // change button text
    this.innerHTML = receiveMode
        ? '<i class="bi bi-x-circle"></i> Cancel Receive'
        : '<i class="bi bi-arrow-down-circle"></i> Receive Items';
});

// SELECT ALL
function toggleAll(source) {
    let checkboxes = document.querySelectorAll('input[name="ids[]"]');
    checkboxes.forEach(cb => cb.checked = source.checked);
}
</script>

@endsection