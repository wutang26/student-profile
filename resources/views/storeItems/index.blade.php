@extends('layouts.admin')

@section('content')
<div class="container">

    <h3 class="mb-4">Store Items</h3><br>

    <a href="{{ route('storeItems.create') }}" class="btn btn-primary mb-3">
        + Add Item
    </a> <br><br>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Category</th>
                        <th>Total</th>
                        <th>Available</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($items as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->category }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>
                            <span class="badge bg-success">
                                {{ $item->available_quantity }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('storeItems.edit', $item) }}" class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('storeItems.destroy', $item) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection