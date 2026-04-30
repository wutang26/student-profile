@extends('layouts.admin')

@section('content')

<style>
    /* PAGE TITLE */
    .page-title {
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    /* GRID */
    .grid-3 {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 20px;
    }

    @media (max-width: 768px) {
        .grid-3 {
            grid-template-columns: 1fr;
        }
    }

    /* CARD */
    .card {
        background: #fff;
        padding: 16px;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .card h2 {
        color: #6b7280;
        font-size: 14px;
        margin-bottom: 8px;
    }

    .card p {
        font-size: 28px;
        font-weight: bold;
    }

    /* SUCCESS MESSAGE */
    .success {
        background: #d1fae5;
        color: #065f46;
        padding: 10px;
        border-radius: 6px;
        margin-bottom: 15px;
    }

    /* BUTTON LINK */
    .btn {
        background: #bbf7d0;
        color: #000;
        padding: 10px 14px;
        border-radius: 20px;
        font-size: 16px;
        text-decoration: none;
        display: inline-block;
        margin-bottom: 15px;
    }

    .btn:hover {
        background: #86efac;
    }

    /* TABLE */
    .table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
        background: #fff;
    }

    .table th, .table td {
        border: 1px solid #d1d5db;
        padding: 10px;
        text-align: left;
    }

    .table thead {
        background: #f3f4f6;
    }

    .table tr:hover {
        background: #f9fafb;
    }

    /* ACTIONS */
    .actions {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .btn-edit {
        background: #3b82f6;
        color: #fff;
        padding: 6px 12px;
        border-radius: 20px;
        text-decoration: none;
        font-size: 13px;
    }

    .btn-edit:hover {
        background: #2563eb;
    }

    .btn-delete {
        background: #ef4444;
        color: #fff;
        padding: 6px 12px;
        border-radius: 20px;
        border: none;
        font-size: 13px;
        cursor: pointer;
    }

    .btn-delete:hover {
        background: #dc2626;
    }

    /* TABLE WRAPPER */
    .table-card {
        background: #fff;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        overflow-x: auto;
    }
</style>

<h1 class="page-title">Regions Summary</h1>

<!-- SUMMARY CARDS -->
<div class="grid-3">

    <div class="card">
        <h2>Total Regions</h2>
        <p>{{ $regions->count() }}</p>
    </div>

    <div class="card">
        <h2>Active Regions</h2>
        <p>{{ $regions->count() }}</p>
    </div>

    <div class="card">
        <h2>Total Disbursed</h2>
        <p>{{ $regions->count() }}</p>
    </div>

</div>

<!-- SUCCESS MESSAGE -->
@if(session('success'))
    <div class="success">
        {{ session('success') }}
    </div>
@endif

<!-- CREATE BUTTON -->
@auth
    @role('super-admin|admin')
        <a href="{{ route('settings.regions.create_region') }}" class="btn">
            Register Regions
        </a>
    @endrole
@endauth

<!-- TABLE -->
<div class="table-card">

    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Region Name</th>

                @auth
                    @role('super-admin|admin')
                        <th>Actions</th>
                    @endrole
                @endauth

            </tr>
        </thead>

        <tbody>
            @foreach($regions as $region)
                <tr>
                    <td>{{ $region->id }}</td>
                    <td>{{ $region->name }}</td>

                    @auth
                        @role('super-admin|admin')
                        <td>
                            <div class="actions">

                                <a href="{{ route('settings.regions.editRegion', $region->id) }}"
                                   class="btn-edit">
                                    Edit
                                </a>

                                <form action="{{ route('settings.regions.deleteRegion', $region->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this region?');">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn-delete">
                                        Delete
                                    </button>
                                </form>

                            </div>
                        </td>
                        @endrole
                    @endauth

                </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection