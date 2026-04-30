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

    /* BUTTON */
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

    /* ACTION BUTTONS */
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

    .actions {
        display: flex;
        gap: 8px;
        align-items: center;
    }
</style>

<h1 class="page-title">Districts Summary</h1>

<div class="grid-3">

    <div class="card">
        <h2>Total Districts</h2>
        <p>{{ $districts->count() }}</p>
    </div>

    <div class="card">
        <h2>Active Districts</h2>
        <p>{{ $districts->count() }}</p>
    </div>

    <div class="card">
        <h2>Total Disbursed</h2>
        <p>{{ $districts->count() }}</p>
    </div>

</div>

<br><br>

@if(session('success'))
    <div class="success">
        {{ session('success') }}
    </div>
@endif

@php $i = 0; @endphp

<div class="card">

    @auth
        @role('super-admin|admin')
            <a href="{{ route('settings.districts.create_district') }}" class="btn">
                Register Districts
            </a>
        @endrole
    @endauth

    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>District Name</th>
                @auth
                    @role('super-admin|admin')
                        <th>Actions</th>
                    @endrole
                @endauth
            </tr>
        </thead>

        <tbody>
            @foreach ($districts as $district)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $district->name }}</td>

                    @auth
                        @role('super-admin|admin')
                        <td>
                            <div class="actions">

                                <a href="{{ route('settings.districts.edit_district', $district->id) }}"
                                   class="btn-edit">
                                    Edit
                                </a>

                                <form action="{{ route('settings.districts.deleteDistrict', $district->id) }}" method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this district?');">
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