@extends('layouts.admin')

@section('content')

<style>
.table-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.06);
    padding: 20px;
}

.badge-returned {
    background: #dcfce7;
    color: #166534;
    padding: 5px 10px;
    border-radius: 8px;
}

.badge-borrowed {
    background: #fef3c7;
    color: #92400e;
    padding: 5px 10px;
    border-radius: 8px;
}
</style>

<div class="container-fluid">

    <div class="d-flex justify-content-between mb-3">
        <h4>📦 Returned Items</h4>
    </div>

    <div class="table-card">

        <table class="table table-hover">
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
                @foreach($records as $r)
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
                            <span class="badge-returned">Returned</span>
                        @else
                            <span class="badge-borrowed">Borrowed</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>

    </div>

</div>

@endsection