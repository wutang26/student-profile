@extends('layouts.admin')

@section('content')

<style>
/* PAGE WRAPPER */
.page {
    padding: 20px;
    font-family: Arial, sans-serif;
}

/* HEADER */
.page h3 {
    margin-bottom: 15px;
    color: #1e293b;
}

/* BUTTON */
.btn-primary {
    display: inline-block;
    background: #3b82f6;
    color: #fff;
    padding: 10px 14px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 14px;
    margin-bottom: 15px;
}

.btn-primary:hover {
    background: #2563eb;
}

/* CARD */
.card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    overflow: hidden;
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
    text-align: left;
    background: #f1f5f9;
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

/* BADGE */
.badge {
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 12px;
    color: #fff;
}

.badge-success {
    background: #10b981;
}

/* ACTION BUTTONS */
.actions {
    display: flex;
    gap: 6px;
}

.btn {
    border: none;
    padding: 6px 10px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 13px;
    text-decoration: none;
    display: inline-block;
}

/* COLORS */
.btn-warning { background: #f59e0b; color: #fff; }
.btn-danger { background: #ef4444; color: #fff; }

.btn:hover {
    opacity: 0.85;
}

/* INLINE FORM */
form {
    display: inline;
}
</style>

<div class="page">

    <h3>Store Items</h3>

    <a href="{{ route('storeItems.create') }}" class="btn-primary">
        + Add Item
    </a>

    <div class="card">
        <div class="card-body">

            <table class="table">

                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Category</th>
                        <th>Total</th>
                        <th>Available</th>
                        @can('view students')
                        <th>Actions</th>
                        @endcan
                    </tr>
                </thead>

                <tbody>
                    @forelse($items as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->category }}</td>
                        <td>{{ $item->quantity }}</td>

                        <td>
                            <span class="badge badge-success">
                                {{ $item->available_quantity }}
                            </span>
                        </td>

                        @can('view students')
                        <td class="actions">

                            <a href="{{ route('storeItems.edit', $item) }}" class="btn btn-warning">
                                Edit
                            </a>

                            <form action="{{ route('storeItems.destroy', $item) }}" method="POST"
                                  onsubmit="return confirm('Delete this item?')">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger">
                                    Delete
                                </button>
                            </form>

                        </td>
                        @endcan

                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align:center; padding:20px; color:#94a3b8;">
                            No items found
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>

        </div>
    </div>

</div>

@endsection